<?php

namespace App\Controllers;

use App\Models\PitanjeModel;
use App\Models\OdgovorModel;
use App\Models\KorisnikModel;
use App\Models\KategorijaPitanjaModel;

class Korisnik extends BaseController
{
	public function index()
	{
		echo view("pocetna_stranica");
		//return view('welcome_message');
	}

	// zelim da odgovorim na pitanje ciji je id proslednjen
	// prikazace se forma za cuvanje novog odgovora na odabrano pitanje
	public function odgovori_na_pitanje($idPitanje=null){
		$controller=session()->get('controller');
		if ($idPitanje == null)  return redirect()->to(site_url("$controller/"));
		$pitanjeModel = new PitanjeModel();
		$pitanje = $pitanjeModel->find($idPitanje);
		echo view("odgovori_na_pitanje", ['pitanje' => $pitanje]);
	}

	// kada se submit forma poziva se ova funkcija kako bi se sacuvao odgovor u bazi
	public function odgovoriNaPitanje($idPitanje = null){
		$controller=session()->get('controller');
		
		if ($idPitanje == null) {
			return redirect()->to(site_url("$controller/"));
		}

	    // ako je nepostojeci id treba vratiti korisnika na pocetnu stranu
        $pitanjeModel = new PitanjeModel();
		$pitanje = $pitanjeModel->find($idPitanje);	
		if ($pitanje == null) {
			return redirect()->to(site_url("$controller/"));
		}

		// koje sve poruke mogu da se prikazu korisniku
		$porukaTekstOdgovora=null;
		$porukaNemaPravaDaOdgovori=null;

		// provera da li je unet tekst odgovora posto je obavezno polje
		if(!$this->validate(['TekstOdgovora'=>'required'])) 
			{
				$porukaTekstOdgovora="Morate da unesete tekst odgovora - to je obavezno polje!";
			}	
		
		// provera da li korisnik ima pravo da odgovori na izabrano pitanje
		// ako korisnik nije psiholog a na pitanje smeju samo psiholozi da odgovore potrebno je ispisati poruku korisniku
		$pitanjeModel = new PitanjeModel();
		$pitanje = $pitanjeModel->find($idPitanje);	
		$moguSviDaOdgovore=$pitanje->moguSviDaOdgovore;
		$korisnikModel=new KorisnikModel();
		$idKategorijaKorisnika=$korisnikModel->find(session()->get('userid'))->tipKorisnika_idTipKorisnika;
		// psiholozi su idKategorijaKorisnika=2 
		if ($moguSviDaOdgovore==0 && $idKategorijaKorisnika!=2){
            $porukaNemaPravaDaOdgovori="Na ovo pitanje imaju pravo samo registrovani psiholozi da odgovore!";
		}
		
		// ako nije unet tekst odgovora ili korisnik nema prava da odgovori ispisati mu poruke, odbacuje se unos odgovora
		if ($porukaTekstOdgovora!=null || $porukaNemaPravaDaOdgovori!=null){
			echo view("odgovori_na_pitanje", ['pitanje'=>$pitanje, 'porukaTekstOdgovora' => $porukaTekstOdgovora, 'porukaNemaPravaDaOdgovori' => $porukaNemaPravaDaOdgovori]);
			return;
		}		

		$odgovorModel = new OdgovorModel();
		$anonimno = $this->request->getVar('anonimus');
		$odgovorModel->save([
						'pitanje_idPitanje'=>$idPitanje,
						'korisnik_idKorisnik_odgovorio'=>session()->get('userid'),
						'tekstOdgovora'=>$this->request->getVar('TekstOdgovora'),
						'odgovorenoAnonimno'=>$anonimno=="1" ? true : false
				]);
		
		$controller=session()->get('controller');
		// kada se sacuva odgovor na pitanje, redirect korisnika na prikaz svih odgovora na to pitanje
		return redirect()->to(site_url("$controller/pregledOdgovora?pretraga=$idPitanje"));
	}

	public function pregledOdgovora() {
            $odgovorModel = new OdgovorModel();
            $pitanjeModel = new PitanjeModel();
            if ($this->request->getVar('pretraga')==null)  return redirect()->to(site_url('/'));
            else {
			$pitanjeId = $this->request->getVar('pretraga');
			$pitanje = $pitanjeModel->find($pitanjeId);
			// ako ne postoji pitanje za koje gledamo odgovore
			if ($pitanje == null) {
				return redirect()->to(site_url('/'));
			}

            $odgovori = $odgovorModel->pregledOdgovoraNaPitanje($pitanjeId);
            echo view("odgovori", ['odgovori' => $odgovori, 'pitanje' => $pitanje]);
        }
    }

	// prikazuje se forma za postavljanje pitanja
	public function postavi_pitanje(){
		echo view("postavi_pitanje");
	}

	// unos pitanja u bazu odnosno citanje podataka iz forme
	public function postaviPitanje(){
        // koje sve poruke mogu da se prikazu korisniku
		$porukaKategorija=null; 
		$porukaNaslovPitanja=null;
		$porukaTekstPitanja=null;

		// provera da li je uneta kategorija, ako ne potrebno je ispisati poruku
		$kategorija=$this->request->getVar('category');
		if($kategorija=="Nema") 
		{
			$porukaKategorija="Morate da unesete kategoriju pitanja - to je obavezno polje!";
        }
		if(!$this->validate(['NaslovPitanja'=>'required'])) 
			{
				$porukaNaslovPitanja="Morate da unesete naslov pitanja - to je obavezno polje!";
			}
		if(!$this->validate(['TekstPitanja'=>'required'])) 
			{
				$porukaTekstPitanja="Morate da unesete tekst pitanja - to je obavezno polje!";
			}	
		if ($porukaKategorija!=null || $porukaNaslovPitanja!=null || $porukaNaslovPitanja!=null){
			echo view("postavi_pitanje", 
			['porukaKategorija' => $porukaKategorija, 'porukaNaslovPitanja' => $porukaNaslovPitanja,'porukaTekstPitanja' => $porukaTekstPitanja]);
		     return;
		}
		$pitanjeModel = new PitanjeModel();   		
		$kategorijaPitanjaModel=new KategorijaPitanjaModel();
		$idKategorije=$kategorijaPitanjaModel->findQuestionCategoryId($kategorija);
		$anonimno = $this->request->getVar('anonimus');
		$mozeDaOdgovori=$this->request->getVar('koOdgovaraNaPitanje');
		if ($mozeDaOdgovori=="Svi") $svi=true; else $svi=false;
		$pitanjeModel->save([
			'korisnik_idKorisnik_postavio'=>session()->get('userid'),
			'kategorijaPitanja_idKategorija'=>$idKategorije,
			'naslovPitanja'=>$this->request->getVar('NaslovPitanja'),
			'tekstPitanja'=>$this->request->getVar('TekstPitanja'),
			'postavljenoAnonimno'=>$anonimno=="1" ? true : false,
			'moguSviDaOdgovore'=>$svi
		]);
        $controller=session()->get('controller');
		// kada korisnik unese pitanje neka predje na pregled pitanja gde moze da nadje svoje tek dodato pitanje
		return redirect()->to(site_url("$controller/pregled_pitanja"));		
	}

	// prikaz profila korisnika ciji smo id prosledili 
	public function profil($userId){
    echo view("profil");

	}
}

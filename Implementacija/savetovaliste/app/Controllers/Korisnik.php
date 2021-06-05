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
	public function odgovori_na_pitanje($idPitanje){
		$pitanjeModel = new PitanjeModel();
		$pitanje = $pitanjeModel->find($idPitanje);
		echo view("odgovori_na_pitanje", ['pitanje' => $pitanje]);
	}

	// kada se submit forma poziva se ova funkcija kako bi se sacuvao odgovor u bazi
	public function odgovoriNaPitanje($idPitanje){
		$pitanjeModel = new PitanjeModel();
		$pitanje = $pitanjeModel->find($idPitanje);
		if (!$this->validate(['TekstOdgovora' => 'required'])) {
			echo view("odgovori_na_pitanje", ['pitanje' => $pitanje, 'poruka' => $this->validator->listErrors()]);
			return;
		}
		// provera da li korisnik ima pravo da odgovori na izabrano pitanje
		// ako korisnik nije psiholog a na pitanje smeju samo psiholozi da odgovore potrebno je ispisati poruku korisniku
        $moguSviDaOdgovore=$pitanje->moguSviDaOdgovore;
		$korisnikModel=new KorisnikModel();
		$idKategorijaKorisnika=$korisnikModel->find(session()->get('userid'))->tipKorisnika_idTipKorisnika;
		// psiholozi su idKategorijaKorisnika=2 
		if ($moguSviDaOdgovore==0 && $idKategorijaKorisnika!=2){
            echo view("odgovori_na_pitanje", ['pitanje' => $pitanje, 
			'poruka' => "Morate biti registrovani psiholog da biste imali pravo da odgovorite na ovo pitanje!"]);
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
            $odgovori = $odgovorModel->pregledOdgovoraNaPitanje($pitanjeId);
            $pitanje = $pitanjeModel->find($pitanjeId);
            echo view("odgovori", ['odgovori' => $odgovori, 'pitanje' => $pitanje]);
        }
    }

	// prikazuje se forma za postavljanje pitanja
	public function postavi_pitanje(){
		echo view("postavi_pitanje");
	}

	// unos pitanja u bazu odnosno citanje podataka iz forme
	public function postaviPitanje(){
		if(!$this->validate(['category'=>'required','NaslovPitanja'=>'required','TekstPitanja'=>'required'])) 
			{
				echo view("postavi_pitanje", ['poruka' => $this->validator->listErrors()]);
				return;
			}	
		$pitanjeModel = new PitanjeModel();   
		$kategorija=$this->request->getVar('category');
		if($kategorija=="Nema") 
		{
			echo view("postavi_pitanje", ['poruka' => "Morate da unesete kategoriju pitanja!"]);
			return;
        }
		
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
}

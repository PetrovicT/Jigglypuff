<?php

namespace App\Controllers;

use App\Models\PitanjeModel;
use App\Models\OdgovorModel;
use App\Models\KorisnikModel;
use App\Models\GradModel;
use App\Models\KategorijaPitanjaModel;
use App\Models\TipKorisnikaModel;


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
    // Pravi AJAX odgovor sa ispisom
    private function responseWithIspis($statusCode, $reason, $ispis) {
        $response = [
            'ispis' => $ispis
        ];
        return $this->response
                        ->setStatusCode($statusCode, $reason)
                        ->setJSON($response);
    }

    // Prijavi korisnika na seansu ako nije već prijavljen
    // Odjavi korisnika sa seanse ako jeste već prijavljen
    public function prijavi_odjavi_seansu() {
        // Ako nije pristupljeno funkciji klikom na dugme,
        // nego preko URL-a, vrati ga nazad
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }
        // Parametri iz sessiona i requesta
        $idKorisnik = $this->session->get('userid');
        $idSeansa = $this->request->getPost('id');

        // Ako nisu prisutni, zahtev je loš, vrati grešku 400
        if (!$idKorisnik || !$idSeansa) {
            return $this->responseWithIspis(400,
                            "Parametar nije prisutan (idKorisnik = $idKorisnik; idSeansa = $idSeansa)",
                            'Loše poslat zahtev, molimo probajte ponovo.<br/>Ako se ovaj problem desi više puta, molimo kontaktirajte administratora sajta.');
        }

        // Modeli koji nam trebaju
        $korisnikPrijavljenNaSeansuModel = new KorisnikPrijavljenNaSeansuModel();
        $seansaModel = new SeansaModel();

        // Ako seansa ne postoji, zahtev je loš, vrati grešku 400
        if (!$seansaModel->find($idSeansa)) {
            return $this->responseWithIspis(400,
                            "Nepostojeća seansa",
                            'Loše poslat zahtev, molimo probajte ponovo.<br/>Ako se ovaj problem desi više puta, molimo kontaktirajte administratora sajta.');
        }

        // Nađi prijavu ako postoji
        $postojecaPrijava = $korisnikPrijavljenNaSeansuModel->findPrijava($idKorisnik, $idSeansa);

        // Ako ne postoji moja prijava, prijavi me
        if (!$postojecaPrijava) {
            // Ako je već prijavljen maksimalan broj korisnika, ipak me nemoj prijaviti
            if ($seansaModel->isSeansaFull($idSeansa)) {
                return $this->responseWithIspis(400,
                                "Puna seansa!",
                                'Već je prijavljen maksimalan broj učesnika :(');
            }

            // Ako ima slobodnog mesta, nastavi sa prijavom
            $korisnikPrijavljenNaSeansuModel->addPrijava($idKorisnik, $idSeansa);
            return $this->responseWithIspis(201,
                            "Uspešna prijava!",
                            'Uspešna prijava na seansu!');
        }
        // A ako postoji moja prijava, odjavi me
        else {
            $korisnikPrijavljenNaSeansuModel->deletePrijava($idKorisnik, $idSeansa);
            return $this->responseWithIspis(209,
                            "Uspešna odjava!",
                            'Uspešna odjava sa seanse.');
        }
    }

	// svi registrovani korisnici imaju mogucnost da izmene svoj profil
	public function profilIzmena(){
		echo view ("profilIzmena");
	}

	public function izmeniProfil(){
		// ako korisnik nije uneo staru lozinku onda mu ispisi poruku
		$porukaNijeUnetaLozinka=null; 
        // ako je korisnik pokusao da promeni profil ali je uneo pogresnu aktuelnu lozinku
		$porukaPogresnaLozinka=null;

		// provera da li je uneta stara lozinka, ako ne potrebno je ispisati poruku
		$lozinka=$this->request->getVar('aktuelnaLozinka');
		if($lozinka==null) 
		{
			$porukaNijeUnetaLozinka="Morate da unesete aktuelnu lozinku da biste napravili izmene!";
        }
		if ($porukaNijeUnetaLozinka!=null){
			echo view("profilIzmena", 
			['porukaLozinka' => $porukaNijeUnetaLozinka]);
		     return;
		}

		// da li je uneta prava lozinka?
        $korisnikId=session()->get('userid');
        $korisnikModel=new KorisnikModel();
        $korisnik=$korisnikModel->find("$korisnikId");
        $tacnalozinka=$korisnik->password;
		$unetaLozinka=$this->request->getVar('aktuelnaLozinka');
		if ($tacnalozinka!=$unetaLozinka) {
			$porukaPogresnaLozinka="Morate da unesete ispravnu aktuelnu lozinku da biste napravili izmene!";
		}
		if ($porukaPogresnaLozinka!=null){
			echo view("profilIzmena", 
			['porukaPogresnaLozinka' => $porukaPogresnaLozinka]);
		     return;
		}

        // dohvatanje grada
        $idGrada=$korisnik->grad_idGrad;
        // dohvatanje pola
        $idPola=$korisnik->pol_idPol;
        // dohvatanje username
        $username=$korisnik->username;
        // dohvatanje licnog imena
        $licnoIme=$korisnik->licnoIme;
        // dohvatanje email
        $email=$korisnik->email;
        // dohvatanje kategorije korisnika
        $idKategorije=$korisnik->tipKorisnika_idTipKorisnika;
        $tipKorisnikaModel=new TipKorisnikaModel();
        $kategorija=$tipKorisnikaModel->find($idKategorije)->tip;

		$noviUsername = $this->request->getVar('username');
		$novoLicnoIme = $this->request->getVar('licnoIme');

		// unosi se grad u tekstualnom obliku, potrebno je prebaciti u idGrada
		$noviGrad = $this->request->getVar('grad');
		if ($noviGrad!=null){
        $gradModel=new GradModel();
		$grad = $gradModel->where('naziv', $noviGrad)->first();
			if ($grad == null) {
				// potrebno je ubaciti novi grad u bazu
				$gradModel->save([
					'naziv'=>$noviGrad
				]);
			} 
		else $noviGrad=$grad->idGrad;
	    } else $noviGrad=$idGrada;
        
		$novEmail = $this->request->getVar('email');
		$noviPol = $this->request->getVar('pol');
		if ($noviPol==null) $noviPol=$idPola;
		else if($noviPol=="male") $noviPol=1;
		else if($noviPol=="female") $noviPol=2;
		else if($noviPol=="other") $noviPol=null;
		
		$novaLozinka = $this->request->getVar('novaLozinka');

		if ($noviUsername==null) $noviUsername=$username;
		if ($novoLicnoIme==null) $novoLicnoIme=$licnoIme;
		if ($novaLozinka==null) $novaLozinka=$tacnalozinka;
		if ($novEmail==null) $novEmail=$email;
     
		echo "$korisnikId";
		echo "$noviUsername";
		echo "$novEmail";
		echo "$novoLicnoIme";
		echo "$novaLozinka";
		echo "$noviGrad";
		echo "$noviPol";

		$db      = \Config\Database::connect();
		$builder = $db->table('korisnik');
		$builder->where('idKorisnik', $korisnikId);
		$data = [
			'username'=>"$noviUsername",
			'email'=>"$novEmail",
			'licnoIme'=>"$novoLicnoIme",
			'prikaziLicnoIme'=>$korisnik->prikaziLicnoIme,
			'password'=>$novaLozinka,
			'tipKorisnika_idTipKorisnika'=>$korisnik->tipKorisnika_idTipKorisnika,
			'grad_idGrad'=>$noviGrad,
			'pol_idPol'=>$noviPol
		];
		$korisnikModel->update($korisnikId, $data);
		
		/*
		$query=$db->query("UPDATE `korisnik` SET `username` = 'MareI2', `prikaziLicnoIme` = b'1' WHERE `korisnik`.`idKorisnik` = 1");
		$query->getResult();
 		*/

		/*
		$korisnikModel->save([
			'idKorisnik'=>$korisnikId,
			'username'=>$noviUsername,
			'email'=>$novEmail,
			'licnoIme'=>$novoLicnoIme,
			'prikaziLicnoIme'=>$korisnik->prikaziLicnoIme,
			'password'=>$novaLozinka,
			'tipKorisnika_idTipKorisnika'=>$korisnik->tipKorisnika_idTipKorisnika,
			'grad_idGrad'=>$noviGrad,
			'pol_idPol'=>$noviPol,
			'slika'=>$korisnik->slika
		]);
		*/

        $controller=session()->get('controller');
	    // kada zavrsi sa izmenama vraca se na pregled profila
		//return redirect()->to(site_url("$controller/profil/$korisnikId"));	
		return;
  	}
}

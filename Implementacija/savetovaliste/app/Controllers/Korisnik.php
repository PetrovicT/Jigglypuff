<?php

namespace App\Controllers;

use App\Models\PitanjeModel;
use App\Models\OdgovorModel;

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
		if(!$this->validate(['TekstOdgovora'=>'required'])) 
			{
				echo view("odgovori_na_pitanje", ['pitanje' => $pitanje,'poruka' => $this->validator->listErrors()]);
				return;
			}
	
		$odgovorModel = new OdgovorModel();
		$anonimno=$this->request->getVar('anonimnost');
		echo "$anonimno"; // dohvata dobro, ali pamti lose nekako
		echo session()->get('userid');  // ostavljeno da bi se videlo da dobro dohvata userid
        $odgovorModel->save([
			'pitanje_idPitanje'=>$idPitanje,
			'korisnik_idKorisnik_odgovorio'=>session()->get('userid'),
			'tekstOdgovora'=>$this->request->getVar('TekstOdgovora'),
			'odgovorenoAnonimno'=>$this->request->getVar('anonimnost')
		]);
        $controller=session()->get('controller');
		return redirect()->to(site_url("$controller/"));		
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
		if($kategorija=="Nema") return echo view("postavi_pitanje", ['poruka' => "Morate da unesete kategoriju pitanja!"]);
        else {
			$kategorijaPitanjaModel=new KategorijaPitanjaModel();
			$idKategorije=$kategorijaPitanjaModel->findQuestionCategoryId($kategorija);
		}
		$pitanjeModel->save([
			'korisnik_idKorisnik_postavio'=>session()->get('userid'),
			'kategorijaPitanja_idKategorija'=>$idKategorije;
			'naslovPitanja'=>$this->request->getVar('NaslovPitanja'),
			'tekstPitanja'=>$this->request->getVar('TekstPitanja'),
			'postavljenoAnonimno'=>0,
			'moguSviDaOdgovore'=>0
		]);
        $controller=session()->get('controller');
		// kada korisnik unese pitanje neka predje na pregled pitanja gde moze da nadje svoje tek dodato pitanje
		return redirect()->to(site_url("$controller/pregled_pitanja"));		
	}
}

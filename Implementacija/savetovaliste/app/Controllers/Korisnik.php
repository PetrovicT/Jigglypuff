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
		if(!$this->validate(['TekstOdgovora'=>'required|max_length[200]'])) 
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
		//return redirect()->to(site_url("$controller/"));		
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
}

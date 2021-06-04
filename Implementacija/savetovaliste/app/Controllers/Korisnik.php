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
	public function odgovoriNaPitanje(){
		
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

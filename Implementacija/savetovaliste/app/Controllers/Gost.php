<?php

namespace App\Controllers;
use App\Models\PitanjeModel;
use App\Models\KorisnikModel;

class Gost extends BaseController
{
    public function index()
    {
            echo view('pocetna_stranica');
    }

    // Stranica za pregled pitanja, ne funkcionalnost pregleda pitanja
    public function pregled_pitanja_stranica($poruka = null){
        echo view("pregled_pitanja", ['pregled_pitanjaErrorMessage' => $poruka]);
    }

    public function pregled_pitanja(){
         $pitanjeModel=new PitanjeModel();
         $pitanja=$pitanjeModel->findAll();
         $this->pregled_pitanja_stranica();
    }
        
    // Stranica za login, ne funkcionalnost logovanja
    public function login($poruka = null) {
        echo view("logovanje", ['loginErrorMessage' => $poruka]);
    }

    // Funkcionalnost logovanja
    public function loginSubmit() {
        // Nije potrebno dodatno validirati username i password jer ako
        // ne zadovoljavaju uslove, neće ni biti u bazi
        if (!$this->validate(['username' => 'required', 'password' => 'required'])) {
            return $this->login("Molimo ukucajte korisničko ime i šifru.");
        }

        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->findByUsername($this->request->getPost('username'));
        if ($korisnik == null) {
            return $this->login("Neispravno korisničko ime!");
        }

        if ($korisnik->password != $this->request->getPost('password')) {
            return $this->login("Pogrešna šifra!");
        }

        // Ovo ćemo da koristimo da identifikujemo korisnika kroz celu upotrebu sajta
        $this->session->set('userid', $korisnik->idKorisnik);

        // A ovo koristimo da uslovno učitavamo stvari;
        // Recimo, različiti headeri se učitavaju u zavisnosti od controllera;
        // Naravno, kontroleri odgovaraju tipovima korisnika, kao što je ranije dogovoreno.
        $this->session->set('controller', $korisnikModel->findUserType($korisnik->idKorisnik));

        return redirect()->to(site_url('Korisnik/'));
    }

}

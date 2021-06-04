<?php

namespace App\Controllers;

use App\Models\TipKorisnikaModel;
use App\Models\KorisnikModel;

class Gost extends BaseController
{
    public function index()
    {
        // Ako nije gost, redirectuj ga na svoj controller
        if($this->session->get('controller')!='Gost'){
            return redirect()->to(site_url($this->session->get('controller') . "/index"));
        }
        echo view("pocetna_stranica");
        //$this->prikaz('pocetna_stranica',[]);
    }

    // Stranica za login, ne funkcionalnost logovanja
    public function login($poruka = null) {
        // Ako nije gost, redirectuj ga na homepage
        if($this->session->get('controller')!='Gost'){
            return redirect()->to(site_url($this->session->get('controller') . "/index"));
        }
        
        echo view("logovanje", ['loginErrorMessage' => $poruka]);
    }

    // Funkcionalnost logovanja
    public function loginSubmit() {
        // Ako nije gost, redirectuj ga na homepage
        if($this->session->get('controller')!='Gost'){
            return redirect()->to(site_url($this->session->get('controller') . "/index"));
        }
        
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

        return redirect()->to(site_url());
    }

    // Stranica za registraciju, ne funkcionalnost registovanja
    public function register($porukaList = null) {
        // Ako nije gost, redirectuj ga na homepage
        if($this->session->get('controller')!='Gost'){
            return redirect()->to(site_url($this->session->get('controller') . "/index"));
        }
        
        echo view("registracija", ['registrationErrorMessages' => $porukaList]);
    }

    // Funkcionalnost registracije
    public function registerSubmit() {
        // Ako nije gost, redirectuj ga na homepage
        if($this->session->get('controller')!='Gost'){
            return redirect()->to(site_url($this->session->get('controller') . "/index"));
        }
        
        // Prvo getujemo tip korisnika koji je običan korisnik
        $tipKorisnikaModel = new TipKorisnikaModel();
        $tipKorisnika = $tipKorisnikaModel->getKorisnikId();

        // Setujemo data prvo
        $data = [
            'username' => $this->request->getPost("username"),
            'password' => $this->request->getPost("password"),
            'email' => $this->request->getPost("email"),
            'licnoIme' => $this->request->getPost("licnoIme"),
            'grad_idGrad' => empty($this->request->getPost("grad")) ? null : $this->request->getPost("grad"),
            'pol_idPol' => empty($this->request->getPost("gender"))? null : $this->request->getPost("gender"),
            'prikaziLicnoIme' => empty($this->request->getPost("licnoIme")) ? 0 : 1,
            'tipKorisnika_idTipKorisnika' => $tipKorisnika,
        ];

        // Pa insert
        $korisnikModel = new KorisnikModel();
        $success = $korisnikModel->insert($data);

        if ($success) {
            $insertedId = $korisnikModel->getInsertID();
            
            // Ovo koristimo da identifikujemo korisnika kroz celu upotrebu sajta
            $this->session->set('userid', $insertedId);

            // A ovo koristimo da uslovno učitavamo stvari
            $this->session->set('controller', $korisnikModel->findUserType($insertedId));

            return redirect()->to(site_url('Korisnik/'));
        }
        else{
            return $this->register($korisnikModel->errors());
        }
    }

}

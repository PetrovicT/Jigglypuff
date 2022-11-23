<?php

namespace App\Controllers;

use App\Models\PitanjeModel;
use App\Models\OdgovorModel;
use App\Models\KorisnikModel;
use App\Models\KategorijaPitanjaModel;
use App\Models\SeansaModel;
use App\Models\KorisnikPrijavljenNaSeansuModel;
use App\Models\KorisnikOcenioPitanjeModel;
use App\Models\KorisnikOcenioOdgovorModel;
use App\Models\KorisnikOcenioPsihologaModel;

class Korisnik extends BaseController {

    public function index() {
        echo view("pocetna_stranica");
        //return view('welcome_message');
    }

    // zelim da odgovorim na pitanje ciji je id proslednjen
    // prikazace se forma za cuvanje novog odgovora na odabrano pitanje
    public function odgovori_na_pitanje($idPitanje = null) {
        $controller = session()->get('controller');
        if ($idPitanje == null)
            return redirect()->to(site_url("$controller/"));
        $pitanjeModel = new PitanjeModel();
        $pitanje = $pitanjeModel->find($idPitanje);
        echo view("odgovori_na_pitanje", ['pitanje' => $pitanje]);
    }

    // kada se submit forma poziva se ova funkcija kako bi se sacuvao odgovor u bazi
    public function odgovoriNaPitanje($idPitanje = null) {
        $controller = session()->get('controller');

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
        $porukaTekstOdgovora = null;
        $porukaNemaPravaDaOdgovori = null;

        // provera da li je unet tekst odgovora posto je obavezno polje
        if (!$this->validate(['TekstOdgovora' => 'required'])) {
            $porukaTekstOdgovora = "Morate da unesete tekst odgovora - to je obavezno polje!";
        }

        // provera da li korisnik ima pravo da odgovori na izabrano pitanje
        // ako korisnik nije psiholog a na pitanje smeju samo psiholozi da odgovore potrebno je ispisati poruku korisniku
        $pitanjeModel = new PitanjeModel();
        $pitanje = $pitanjeModel->find($idPitanje);
        $moguSviDaOdgovore = $pitanje->moguSviDaOdgovore;
        $korisnikModel = new KorisnikModel();
        $idKategorijaKorisnika = $korisnikModel->find(session()->get('userid'))->tipKorisnika_idTipKorisnika;
        // psiholozi su idKategorijaKorisnika=2 
        if ($moguSviDaOdgovore == 0 && $idKategorijaKorisnika != 2) {
            $porukaNemaPravaDaOdgovori = "Na ovo pitanje imaju pravo samo registrovani psiholozi da odgovore!";
        }

        // ako nije unet tekst odgovora ili korisnik nema prava da odgovori ispisati mu poruke, odbacuje se unos odgovora
        if ($porukaTekstOdgovora != null || $porukaNemaPravaDaOdgovori != null) {
            echo view("odgovori_na_pitanje", ['pitanje' => $pitanje, 'porukaTekstOdgovora' => $porukaTekstOdgovora, 'porukaNemaPravaDaOdgovori' => $porukaNemaPravaDaOdgovori]);
            return;
        }

        $odgovorModel = new OdgovorModel();
        $anonimno = $this->request->getVar('anonimus');
        $odgovorModel->save([
            'pitanje_idPitanje' => $idPitanje,
            'korisnik_idKorisnik_odgovorio' => session()->get('userid'),
            'tekstOdgovora' => $this->request->getVar('TekstOdgovora'),
            'odgovorenoAnonimno' => $anonimno == "1" ? true : false
        ]);

        $controller = session()->get('controller');
        // kada se sacuva odgovor na pitanje, redirect korisnika na prikaz svih odgovora na to pitanje
        return redirect()->to(site_url("$controller/pregledOdgovora?pretraga=$idPitanje"));
    }

    public function pregledOdgovora() {
        $odgovorModel = new OdgovorModel();
        $pitanjeModel = new PitanjeModel();
        if ($this->request->getVar('pretraga') == null)
            return redirect()->to(site_url('/'));
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
    public function postavi_pitanje() {
        echo view("postavi_pitanje");
    }

    // unos pitanja u bazu odnosno citanje podataka iz forme
    public function postaviPitanje() {
        // koje sve poruke mogu da se prikazu korisniku
        $porukaKategorija = null;
        $porukaNaslovPitanja = null;
        $porukaTekstPitanja = null;

        // provera da li je uneta kategorija, ako ne potrebno je ispisati poruku
        $kategorija = $this->request->getVar('category');
        if ($kategorija == "Nema") {
            $porukaKategorija = "Morate da unesete kategoriju pitanja - to je obavezno polje!";
        }
        if (!$this->validate(['NaslovPitanja' => 'required'])) {
            $porukaNaslovPitanja = "Morate da unesete naslov pitanja - to je obavezno polje!";
        }
        if (!$this->validate(['TekstPitanja' => 'required'])) {
            $porukaTekstPitanja = "Morate da unesete tekst pitanja - to je obavezno polje!";
        }
        if ($porukaKategorija != null || $porukaNaslovPitanja != null || $porukaNaslovPitanja != null) {
            echo view("postavi_pitanje",
                    ['porukaKategorija' => $porukaKategorija, 'porukaNaslovPitanja' => $porukaNaslovPitanja, 'porukaTekstPitanja' => $porukaTekstPitanja]);
            return;
        }
        $pitanjeModel = new PitanjeModel();
        $kategorijaPitanjaModel = new KategorijaPitanjaModel();
        $idKategorije = $kategorijaPitanjaModel->findQuestionCategoryId($kategorija);
        $anonimno = $this->request->getVar('anonimus');
        $mozeDaOdgovori = $this->request->getVar('koOdgovaraNaPitanje');
        if ($mozeDaOdgovori == "Svi")
            $svi = true;
        else
            $svi = false;
        $pitanjeModel->save([
            'korisnik_idKorisnik_postavio' => session()->get('userid'),
            'kategorijaPitanja_idKategorija' => $idKategorije,
            'naslovPitanja' => $this->request->getVar('NaslovPitanja'),
            'tekstPitanja' => $this->request->getVar('TekstPitanja'),
            'postavljenoAnonimno' => $anonimno == "1" ? true : false,
            'moguSviDaOdgovore' => $svi
        ]);
        $controller = session()->get('controller');
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

    // Toggluje lajk i dislajl na pitanju
    public function like_or_dislike_pitanje() {
        // Ako nije pristupljeno funkciji klikom na dugme,
        // nego preko URL-a, vrati ga nazad
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Parametri iz sessiona i requesta
        $idKorisnik = $this->session->get('userid');
        $idPitanje = $this->request->getPost('id');
        $isLike = $this->request->getPost('isLike');

        // Ako nisu prisutni, zahtev je loš, vrati grešku 400
        if (!$idKorisnik || !$idPitanje || $isLike == null) {
            return $this->responseWithIspis(400,
                            "Parametar nije prisutan (idKorisnik = $idKorisnik; idSeansa = $idPitanje, isLike = $isLike)",
                            'Loše poslat zahtev, molimo probajte ponovo.<br/>Ako se ovaj problem desi više puta, molimo kontaktirajte administratora sajta.');
        }

        $isLike = $isLike == "1" ? true : false;

        $korisnikOcenioPitanjeModel = new KorisnikOcenioPitanjeModel;

        $postojecaOcena = $korisnikOcenioPitanjeModel->findOcena($idKorisnik, $idPitanje);

        // Ako ne postoji ocena, onda daj novu ocenu
        if (!$postojecaOcena) {
            $novaOcena = [
                'ocena' => $isLike,
                'pitanje_idPitanje' => $idPitanje,
                'korisnik_idKorisnik' => $idKorisnik
            ];
            $korisnikOcenioPitanjeModel->insert($novaOcena);

            return $this->responseWithIspis(210,
                            "Uspešna nova ocena!",
                            'Uspešna nova ocena!');
        }
        // A ako postoji, onda je samo updatuj da matchuje novu
        else {
            if ($postojecaOcena->ocena == $isLike) {
                return $this->responseWithIspis(212,
                                "Već je data ista ocena.",
                                'Već je data ista ocena.');
            }

            $postojecaOcena->ocena = $isLike;
            $korisnikOcenioPitanjeModel->save($postojecaOcena);

            return $this->responseWithIspis(211,
                            "Uspešna izmena ocene!",
                            'Uspešna izmena ocene!');
        }
    }

    // Toggluje lajk i dislajk na odgovoru
    public function like_or_dislike_odgovor() {
        // Ako nije pristupljeno funkciji klikom na dugme,
        // nego preko URL-a, vrati ga nazad
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Parametri iz sessiona i requesta
        $idKorisnik = $this->session->get('userid');
        $idOdgovor = $this->request->getPost('id');
        $isLike = $this->request->getPost('isLike');

        // Ako nisu prisutni, zahtev je loš, vrati grešku 400
        if (!$idKorisnik || !$idOdgovor || $isLike == null) {
            return $this->responseWithIspis(400,
                            "Parametar nije prisutan (idKorisnik = $idKorisnik; idSeansa = $idOdgovor, isLike = $isLike)",
                            'Loše poslat zahtev, molimo probajte ponovo.<br/>Ako se ovaj problem desi više puta, molimo kontaktirajte administratora sajta.');
        }

        $isLike = $isLike == "1" ? true : false;

        $korisnikOcenioOdgovorModel = new KorisnikOcenioOdgovorModel();

        $postojecaOcena = $korisnikOcenioOdgovorModel->findOcena($idKorisnik, $idOdgovor);

        // Ako ne postoji ocena, onda daj novu ocenu
        if (!$postojecaOcena) {
            $novaOcena = [
                'ocena' => $isLike,
                'odgovor_idOdgovor' => $idOdgovor,
                'korisnik_idKorisnik' => $idKorisnik
            ];
            $korisnikOcenioOdgovorModel->insert($novaOcena);

            return $this->responseWithIspis(210,
                            "Uspešna nova ocena!",
                            'Uspešna nova ocena!');
        }
        // A ako postoji, onda je samo updatuj da matchuje novu
        else {
            if ($postojecaOcena->ocena == $isLike) {
                return $this->responseWithIspis(212,
                                "Već je data ista ocena.",
                                'Već je data ista ocena.');
            }

            $postojecaOcena->ocena = $isLike;
            $korisnikOcenioOdgovorModel->save($postojecaOcena);

            return $this->responseWithIspis(211,
                            "Uspešna izmena ocene!",
                            'Uspešna izmena ocene!');
        }
    }

    // Toggluje lajk i dislajk na psihologu
    public function like_or_dislike_psiholog() {
        // Ako nije pristupljeno funkciji klikom na dugme,
        // nego preko URL-a, vrati ga nazad
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Parametri iz sessiona i requesta
        $idKorisnik = $this->session->get('userid');
        $idPsiholog = $this->request->getPost('id');
        $isLike = $this->request->getPost('isLike');

        // Ako nisu prisutni, zahtev je loš, vrati grešku 400
        if (!$idKorisnik || !$idPsiholog || $isLike == null) {
            return $this->responseWithIspis(400,
                            "Parametar nije prisutan (idKorisnik = $idKorisnik; idSeansa = $idPsiholog, isLike = $isLike)",
                            'Loše poslat zahtev, molimo probajte ponovo.<br/>Ako se ovaj problem desi više puta, molimo kontaktirajte administratora sajta.');
        }

        $isLike = $isLike == "1" ? true : false;

        $korisnikOcenioPsihologaModel = new KorisnikOcenioPsihologaModel();

        $postojecaOcena = $korisnikOcenioPsihologaModel->findOcena($idKorisnik, $idPsiholog);

        // Ako ne postoji ocena, onda daj novu ocenu
        if (!$postojecaOcena) {
            $novaOcena = [
                'ocena' => $isLike,
                'korisnik_idKorisnik_ocenjen' => $idPsiholog,
                'korisnik_idKorisnik_ocenio' => $idKorisnik
            ];
            $korisnikOcenioPsihologaModel->insert($novaOcena);

            return $this->responseWithIspis(210,
                            "Uspešna nova ocena!",
                            'Uspešna nova ocena!');
        }
        // A ako postoji, onda je samo updatuj da matchuje novu
        else {
            if ($postojecaOcena->ocena == $isLike) {
                return $this->responseWithIspis(212,
                                "Već je data ista ocena.",
                                'Već je data ista ocena.');
            }

            $postojecaOcena->ocena = $isLike;
            $korisnikOcenioPsihologaModel->save($postojecaOcena);

            return $this->responseWithIspis(211,
                            "Uspešna izmena ocene!",
                            'Uspešna izmena ocene!');
        }
    }

    // svi registrovani korisnici imaju mogucnost da izmene svoj profil
    public function profilIzmena() {
        echo view("profilIzmena");
    }

    // Submit izmene profila
    public function izmeniProfil() {
        
        // ako korisnik nije uneo staru lozinku onda mu ispisi poruku
        $porukaNijeUnetaLozinka = null;
        // ako je korisnik pokusao da promeni profil ali je uneo pogresnu aktuelnu lozinku
        $porukaPogresnaLozinka = null;

        // provera da li je uneta stara lozinka, ako ne potrebno je ispisati poruku
        $lozinka = $this->request->getVar('aktuelnaLozinka');
        if ($lozinka == null) {
            $porukaNijeUnetaLozinka = "Morate da unesete aktuelnu lozinku da biste napravili izmene!";
        }
        if ($porukaNijeUnetaLozinka != null) {
            echo view("profilIzmena",
                    ['porukaLozinka' => $porukaNijeUnetaLozinka]);
            return;
        }

        // da li je uneta prava lozinka?
        $korisnikId = session()->get('userid');
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find("$korisnikId");
        $tacnalozinka = $korisnik->password;
        $unetaLozinka = $this->request->getVar('aktuelnaLozinka');
        if ($tacnalozinka != $unetaLozinka) {
            $porukaPogresnaLozinka = "Morate da unesete ispravnu aktuelnu lozinku da biste napravili izmene!";
        }
        if ($porukaPogresnaLozinka != null) {
            echo view("profilIzmena",
                    ['porukaPogresnaLozinka' => $porukaPogresnaLozinka]);
            return;
        }
        
        $novoLicnoIme = $this->request->getVar('licnoIme');

        $noviGradId = $this->request->getVar('grad');
        $novEmail = $this->request->getVar('email');
        $noviPol = $this->request->getVar('gender');

        $novaLozinka = $this->request->getVar('novaLozinka');

        $data = [
            'email' => $novEmail,
            'licnoIme' => $novoLicnoIme,
            'password' => (empty($novaLozinka) ? $korisnik->password : $novaLozinka ),
            'grad_idGrad' => $noviGradId,
            'pol_idPol' => (empty($noviPol) ? null : $noviPol)
        ];
        $korisnikModel->update($korisnikId, $data);

        $controller = session()->get('controller');
        
        // kada zavrsi sa izmenama vraca se na pregled profila
        return redirect()->to(site_url("$controller/profil/$korisnikId"));
    }

    // Xahteva izmenu, tj. salje dokumentaciju u bazu
    public function zahtevajPromociju(){
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($this->session->get('userid'));
        
        $dokumentacija = $this->request->getFile('promocijaFile');
        
        if($dokumentacija == null || !$dokumentacija->isValid()){
            return $this->profilIzmena();
        }
        
        $novoIme = $korisnik->username.'.'.$dokumentacija->getExtension();
        
        // Move the file to it's new home
        $dokumentacija->move('C:\wamp64\uploadedFiles\savetovaliste\zahteviZaPromociju', $novoIme, true);
        
        $noviPath = 'C:\wamp64\uploadedFiles\savetovaliste\zahteviZaPromociju\\'.$novoIme;
        
        $zahteviModel = new \App\Models\ZahteviPromocijeModel();
        $data = [
            'idKorisnika' => $this->session->get('userid'),
            'path' => $noviPath
        ];
        
        $zahteviModel->save($data);
        
        return $this->profilIzmena();
    }
}

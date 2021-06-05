<?php

namespace App\Controllers;

use App\Models\SeansaModel;
use App\Models\KorisnikPrijavljenNaSeansuModel;

class Korisnik extends BaseController {

    public function index() {
        echo view("pocetna_stranica");
        //return view('welcome_message');
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
                            'Uspešna odjava sa seanse. :(');
        }
    }

}

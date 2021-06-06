<?php

namespace App\Controllers;

use App\Models\SeansaModel;

class Psiholog extends Korisnik {

    public function organizovane_seanse() {
        if ($this->session->get('controller') != 'Psiholog' || !$this->session->get('userid')) {
            $controller = $this->session->get('controller');
            return redirect()->to(site_url("$controller/pregled_seansi"));
        }

        $seansaModel = new SeansaModel();

        $sveMojeSeanse = $seansaModel->where('korisnik_idKorisnik_organizator', $this->session->get('userid'))->findAll();

        echo view('moje_seanse', ['sveSeanse' => $sveMojeSeanse]);
    }

}

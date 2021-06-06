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

        $sveMojeSeanse = $seansaModel->findAllForOrganizator($this->session->get('userid'));

        echo view('moje_seanse', ['sveSeanse' => $sveMojeSeanse]);
    }
    
    // Brise seansu ako je ulogovan njen vljasnik
    public function izbrisi_seansu($idSeanse = null){
        if($idSeanse == null){
            return redirect()->back();
        }
        
        // Session data
        $userid = $this->session->get('userid');
        $controller = $this->session->get('controller');
        
        // Prvo provera da li je to seansa ulogovanog korisnika
        $seansaModel = new SeansaModel();
        $seansa = $seansaModel->find($idSeanse);
        if($seansa == null || $seansa->korisnik_idKorisnik_organizator != $userid){
            return redirect()->back();
        }
        
        // Ako je sve ok, obriši je
        $seansaModel->delete($idSeanse);  
        return redirect()->to(site_url("$controller/organizovane_seanse"));
    }

}

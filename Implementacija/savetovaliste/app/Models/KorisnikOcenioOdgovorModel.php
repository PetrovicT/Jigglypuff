<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PitanjeModel;

class KorisnikOcenioOdgovorModel extends Model {

    protected $table = 'korisnik_ocenio_odgovor';
    protected $primaryKey = 'idScapegoat';
    protected $allowedFields = ['ocena', 'odgovor_idOdgovor', 'korisnik_idKorisnik'];
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    // pronalazi broj lajkova na prosledjen odgovor
    public function findNumOfLikes($idOdgovora) {
        $sveOceneNaOdgovor = $this->where('ocena', "1")->where('odgovor_idOdgovor', "$idOdgovora")->findAll();
        if ($sveOceneNaOdgovor == null) {
            return 0;
        }
        $numOfLikes = count($sveOceneNaOdgovor);
        return $numOfLikes;
    }

    // pronalazi broj dislajkova na prosledjen odgovor
    public function findNumOfDislikes($idOdgovora) {
        $sveOceneNaOdgovor = $this->where('ocena', "0")->where('odgovor_idOdgovor', "$idOdgovora")->findAll();
        if ($sveOceneNaOdgovor == null) {
            return 0;
        }
        $numOfDislikes = count($sveOceneNaOdgovor);
        return $numOfDislikes;
    }

    public function findOcena($idKorisnika, $idOcene) {
        $queryBuilder = $this->db->table($this->table);

        return $queryBuilder
                        ->where('korisnik_idKorisnik', $idKorisnika)
                        ->where('odgovor_idOdgovor', $idOcene)
                        ->get()->getFirstRow();
    }

}

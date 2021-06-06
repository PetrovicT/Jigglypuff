<?php

namespace App\Models;

use CodeIgniter\Model;

class KorisnikOcenioPitanjeModel extends Model {

    protected $table = 'korisnik_ocenio_pitanje';
    protected $primaryKey = 'idScapegoat';
    protected $allowedFields = ['ocena', 'pitanje_idPitanje', 'korisnik_idKorisnik'];
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    // pronalazi broj lajkova na prosledjeno pitanje
    public function findNumOfLikes($idPitanja) {
        $sveOceneNaPitanje = $this->where('ocena', "1")->where('pitanje_idPitanje', "$idPitanja")->findAll();
        if ($sveOceneNaPitanje == null) {
            return 0;
        }
        $numOfLikes = count($sveOceneNaPitanje);
        return $numOfLikes;
    }

    // pronalazi broj dislajkova na prosledjeno pitanje
    public function findNumOfDislikes($idPitanja) {
        $sveOceneNaPitanje = $this->where('ocena', "0")->where('pitanje_idPitanje', "$idPitanja")->findAll();
        if ($sveOceneNaPitanje == null) {
            return 0;
        }
        $numOfDislikes = count($sveOceneNaPitanje);
        return $numOfDislikes;
    }

    public function findOcena($idKorisnika, $idPitanja) {
        $queryBuilder = $this->db->table($this->table);

        return $queryBuilder
                        ->where('korisnik_idKorisnik', $idKorisnika)
                        ->where('pitanje_idPitanje', $idPitanja)
                        ->get()->getFirstRow();
    }

}

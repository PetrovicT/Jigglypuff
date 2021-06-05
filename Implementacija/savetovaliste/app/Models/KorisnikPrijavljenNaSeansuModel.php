<?php

namespace App\Models;

use CodeIgniter\Model;

class KorisnikPrijavljenNaSeansuModel extends Model {

    protected $table = 'korisnik_prijavljen_na_seansu';
    protected $allowedFields = ['seansa_idSeansa', 'korisnik_idKorisnik'];
    protected $returnType = 'object';
    protected $useAutoIncrement = false;

    // Nadji broj prijavljenih na seansu sa id-jem
    public function findNumberOfSignedUsers($idSeanse) {
        $queryBuilder = $this->db->table($this->table);
        
        return $queryBuilder->where('seansa_idSeansa', $idSeanse)->countAllResults();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class KorisnikPrijavljenNaSeansuModel extends Model {

    protected $table = 'korisnik_prijavljen_na_seansu';
    protected $primaryKey = 'idScapegoat';
    protected $allowedFields = [ 'korisnik_idKorisnik', 'seansa_idSeansa'];
    protected $returnType = 'object';
    protected $useAutoIncrement = true;

    // Nadji broj prijavljenih na seansu sa id-jem
    public function findNumberOfSignedUsers($idSeanse) {
        $queryBuilder = $this->db->table($this->table);

        return $queryBuilder->where('seansa_idSeansa', $idSeanse)->countAllResults();
    }

    // Nalazi sve prijave gde je korisnik prijavljen
    public function findAllSeanseForKorisnik($idKorisnika) {
        $queryBuilder = $this->db->table($this->table);

        return $queryBuilder->where('korisnik_idKorisnik', $idKorisnika)->get()->getResult();
    }

    // Nalazi prijavu korisnika na seansu, ukoliko postoji
    // Inače vraća null
    public function findPrijava($idKorisnika, $idSeanse) {
        $queryBuilder = $this->db->table($this->table);

        return $queryBuilder
                        ->where('korisnik_idKorisnik', $idKorisnika)
                        ->where('seansa_idSeansa', $idSeanse)
                        ->get()->getResult();
    }

    // Briše prijavu
    public function deletePrijava($idKorisnika, $idSeanse) {
        $this->where('korisnik_idKorisnik', $idKorisnika)
                ->where('seansa_idSeansa', $idSeanse)
                ->delete();
    }

    // Dodaje prijavu
    public function addPrijava($idKorisnika, $idSeanse) {
        $data = [
            'korisnik_idKorisnik' => $idKorisnika,
            'seansa_idSeansa' => $idSeanse
        ];
        $this->insert($data);
    }

}

<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KorisnikPrijavljenNaSeansuModel;

class SeansaModel extends Model {

    protected $table = 'seansa';
    protected $primaryKey = 'idSeansa';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['korisnik_idKorisnik_organizator', 'nazivSeanse', 'opisSeanse', 'maxBrojPrijavljenih', 'datumPocetka', 'vremePocetka', 'zoomLink'];
    // Dodati prilikom pravljenja dodavanja seanse
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function findAllOnDateSorted($date) {
        $queryBuilder = $this->db->table($this->table);

        $queryBuilder->where('datumPocetka', $date);
        $queryBuilder->orderBy('vremePocetka', 'ASC');
        $seanseSorted = $queryBuilder->get();

        return $seanseSorted->getResult();
    }

    public function findAllInFutureSorted() {
        $queryBuilder = $this->db->table($this->table);

        $queryBuilder->where('datumPocetka >= CURRENT_DATE()');
        $queryBuilder->orderBy('datumPocetka', 'ASC');
        $queryBuilder->orderBy('vremePocetka', 'ASC');
        $seanseSorted = $queryBuilder->get();

        return $seanseSorted->getResult();
    }

    public function findAllInFutureSortedLike($keyword) {
        $queryBuilder = $this->db->table($this->table);

        $queryBuilder->where('datumPocetka >= CURRENT_DATE()');
        $queryBuilder->like('nazivSeanse', $keyword)->orLike('opisSeanse', $keyword);
        $queryBuilder->orderBy('datumPocetka', 'ASC');
        $queryBuilder->orderBy('vremePocetka', 'ASC');
        $seanseSorted = $queryBuilder->get();

        return $seanseSorted->getResult();
    }
    
    // Vraća bool da li je seansa puna ili ne
    public function isSeansaFull($idSeanse){
        $korisnikPrijavljenNaSeansuModel = new KorisnikPrijavljenNaSeansuModel();
        return ($korisnikPrijavljenNaSeansuModel->findNumberOfSignedUsers($idSeanse) >= $this->find($idSeanse)->maxBrojPrijavljenih);
    }

}

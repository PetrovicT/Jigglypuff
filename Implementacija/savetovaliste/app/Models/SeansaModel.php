<?php

namespace App\Models;

use CodeIgniter\Model;

class SeansaModel extends Model {    
    protected $table      = 'seansa';
    protected $primaryKey = 'idSeansa';
    protected $returnType = 'object';
        
    protected $useAutoIncrement = true;

    protected $allowedFields = ['korisnik_idKorisnik_organizator', 'nazivSeanse', 'opisSeanse', 'maxBrojPrijavljenih', 'datumPocetka', 'vremePocetka', 'zoomLink'];

    // Dodati prilikom pravljenja dodavanja seanse
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
    public function findAllOnDateSorted($date) {
        $queryBuilder = $this->db->table($this->table);
        
        $queryBuilder->where('datumPocetka', $date);
        $queryBuilder->orderBy('vremePocetka','ASC');
        $seanseSorted = $queryBuilder->get();

        return $seanseSorted->getResult();
    }
}

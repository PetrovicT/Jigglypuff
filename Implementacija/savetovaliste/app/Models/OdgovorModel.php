<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\TipKorisnikaModel;

class OdgovorModel extends Model
{
        protected $table      = 'odgovor';
        protected $primaryKey = 'idOdgovor';
        protected $allowedFields = ['pitanje_idPitanje', 'korisnik_idKorisnik_odgovorio', 'tekstOdgovora', 'odgovorenoAnonimno'];
        protected $returnType = 'object';
    
        public function pregledOdgovoraNaPitanje($idPitanja){
            return $this->where('pitanje_idPitanje',"$idPitanja")->findAll();
        }
}
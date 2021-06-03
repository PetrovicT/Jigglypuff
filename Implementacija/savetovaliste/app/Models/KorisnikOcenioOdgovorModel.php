<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PitanjeModel;

class KorisnikOcenioOdgovorModel extends Model
{
        protected $table      = 'korisnik_ocenio_odgovor';
        protected $allowedFields = ['ocena'];
        protected $returnType = 'object';
        
        public function findNumOfLikes($idOdgovora){
            $sveOceneNaOdgovor =  $this->where('ocena',"1")->where('odgovor_idOdgovor', "$idOdgovora")->findAll();
            if ($sveOceneNaOdgovor == null) {return 0;}
            $numOfLikes=count($sveOceneNaOdgovor); 
            return $numOfLikes;
        }

        public function findNumOfDislikes($idOdgovora){
            $sveOceneNaOdgovor =  $this->where('ocena',"0")->where('odgovor_idOdgovor', "$idOdgovora")->findAll();
            if ($sveOceneNaOdgovor == null) {return 0;}
            $numOfDislikes=count($sveOceneNaOdgovor); 
            return $numOfDislikes;
        }
}
<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PitanjeModel;

class KorisnikOcenioPitanjeModel extends Model
{
        protected $table      = 'korisnik_ocenio_pitanje';
        protected $allowedFields = ['ocena'];
        protected $returnType = 'object';
        
        public function findNumOfLikes($idPitanja){
            $sveOceneNaPitanje =  $this->where('ocena',"1")->where('pitanje_idPitanje', "$idPitanja")->findAll();
            if ($sveOceneNaPitanje == null) {echo "Greska"; return null;}
            $numOfLikes=count($sveOceneNaPitanje); 
            return $numOfLikes;
        }

        public function findNumOfDislikes($idPitanja){
            $sveOceneNaPitanje =  $this->where('ocena',"0")->where('pitanje_idPitanje', "$idPitanja")->findAll();
            if ($sveOceneNaPitanje == null) {echo "Greska"; return null;}
            $numOfDislikes=count($sveOceneNaPitanje); 
            return $numOfDislikes;
        }
}
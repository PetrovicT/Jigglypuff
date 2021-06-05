<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PitanjeModel;

class KorisnikOcenioPitanjeModel extends Model
{
        protected $table      = 'korisnik_ocenio_pitanje';
        protected $primaryKey = 'idScapegoat';
        protected $allowedFields = ['ocena','pitanje_idPitanje','korisnik_idKorisnik'];
        protected $returnType = 'object';
        protected $useAutoIncrement = true;
        
         // pronalazi broj lajkova na prosledjeno pitanje
        public function findNumOfLikes($idPitanja){
            $sveOceneNaPitanje =  $this->where('ocena',"1")->where('pitanje_idPitanje', "$idPitanja")->findAll();
            if ($sveOceneNaPitanje == null) {return 0;}
            $numOfLikes=count($sveOceneNaPitanje); 
            return $numOfLikes;
        }
        
         // pronalazi broj lajkova na prosledjeno pitanje
        public function findNumOfDislikes($idPitanja){
            $sveOceneNaPitanje =  $this->where('ocena',"0")->where('pitanje_idPitanje', "$idPitanja")->findAll();
            if ($sveOceneNaPitanje == null) {return 0;}
            $numOfDislikes=count($sveOceneNaPitanje); 
            return $numOfDislikes;
        }
}
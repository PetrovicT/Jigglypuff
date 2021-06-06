<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PitanjeModel;

class KorisnikOcenioPsihologaModel extends Model
{
        protected $table      = 'korisnik_ocenio_psihologa';
        protected $allowedFields = ['ocena','korisnik_idKorisnik_ocenio','korisnik_idKorisnik_ocenjen'];
        protected $returnType = 'object';
        protected $useAutoIncrement = false;
        
         // pronalazi broj pozitivnih ocena na psihologa ciji id prosledjujemo
        public function findNumOfLikes($idPsihologa){
            $sveOceneNaPsihologa =  $this->where('ocena',"1")->where('korisnik_idKorisnik_ocenjen', "$idPsihologa")->findAll();
            if ($sveOceneNaPsihologa == null) {return 0;}
            $numOfLikes=count($sveOceneNaPsihologa); 
            return $numOfLikes;
        }
        
         // pronalazi broj negativnih ocena na psihologa ciji id prosledjujemo
        public function findNumOfDislikes($idPsihologa){
            $sveOceneNaPsihologa =  $this->where('ocena',"0")->where('korisnik_idKorisnik_ocenjen', "$idPsihologa")->findAll();
            if ($sveOceneNaPsihologa == null) {return 0;}
            $numOfDislikes=count($sveOceneNaPsihologa); 
            return $numOfDislikes;
        }
}
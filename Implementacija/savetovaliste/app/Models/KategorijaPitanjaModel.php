<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PitanjeModel;

class KategorijaPitanjaModel extends Model
{
        protected $table      = 'kategorija_pitanja';
        protected $primaryKey = 'idKategorijaPitanja';
        protected $allowedFields = []; // ne dodaju se nove kategorije
        protected $returnType = 'object';
        
        // funkciji se prosledjuje kategorija u obliku stringa, a dobija se kao povratna vrednost id kategorije
        public function findQuestionCategoryId($stringKategorija){
            $kategorija =  $this->where('kategorija', $stringKategorija)->first();
            if ($kategorija == null) {echo "Greska"; return null;}
            return $kategorija->idKategorijaPitanja;
        }
}
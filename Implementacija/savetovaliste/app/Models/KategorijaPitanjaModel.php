<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\PitanjeModel;

class KategorijaPitanjaModel extends Model
{
        protected $table      = 'kategorija_pitanja';
        protected $primaryKey = 'idKategorijaPitanja';
        protected $allowedFields = ['kategorija'];
        protected $returnType = 'object';
        
        public function findQuestionCategoryId($stringKategorija){
            $kategorija =  $this->where('kategorija', $stringKategorija)->first();
            if ($kategorija == null) {echo "Greska"; return null;}
            return $kategorija->idKategorijaPitanja;
        }
}
<?php namespace App\Models;

use CodeIgniter\Model;

class GradModel extends Model
{
        protected $table      = 'grad';
        protected $primaryKey = 'idGrad';
        protected $returnType = 'object';
        
        // Vraća sortiranu listu gradova
        public function findAllAlphabetical(){
            $queryBuilder = $this->db->table($this->table);
            
            $queryBuilder->orderBy('naziv','ASC');
            
            $gradoviSorted = $queryBuilder->get();
            
            return $gradoviSorted->getResult();
        }

        // vraca naziv grada ciji id prosledimo
        public function nadjiNazivGrada($idGrada){
            return $this->find($idGrada)->naziv;
        }
}
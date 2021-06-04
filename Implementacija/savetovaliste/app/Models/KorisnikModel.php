<?php namespace App\Models;

use CodeIgniter\Model;

use App\Models\TipKorisnikaModel;

class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'idKorisnik';
        protected $returnType = 'object';
    
        // Funkciji se prosledjuje username, a ona vraca korisnika sa tim username
        public function findByUsername($username){
            return $this->where('username', $username)->first();
        }
        
        // Vraća string koji označava da li je korisnik običan korisnik, psiholog ili admin, ili pak nešto novo ako dodamo
        // String se dobija iz baze
        public function findUserType($id){
            $korisnik = $this->find($id);
            
            $tipKorisnikaModel = new TipKorisnikaModel();
            $tipKorisnika = $tipKorisnikaModel->find($korisnik->tipKorisnika_idTipKorisnika);
            
            if($tipKorisnika == null){
                return null;
            }
            
            return $tipKorisnika->tip;
        }
        
        // funkciji se prosledjuje id korisnika, a ona vraca username 
        // koristi se prilikom ispisa autora pitanja/odgovora
        public function findUserUsername($id){
            $korisnik = $this->find($id);
            if($korisnik == null){
                return null;
            }       
            return $korisnik->username;
        }
        
}
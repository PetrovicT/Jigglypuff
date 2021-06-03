<?php namespace App\Models;

use CodeIgniter\Model;

use App\Models\TipKorisnikaModel;

class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'idKorisnik';
        protected $returnType = 'object';
    
        // Proslediš ime, i on vrati korisnika
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
        
        public function findUserUsername($id){
            $korisnik = $this->find($id);
            if($korisnik == null){
                return null;
            }       
            return $korisnik->username;
        }
        
}
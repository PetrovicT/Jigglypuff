<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\TipKorisnikaModel;

class KorisnikModel extends Model {

    protected $table = 'korisnik';
    protected $primaryKey = 'idKorisnik';
    protected $returnType = 'object';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['username', 'password', 'email', 'licnoIme', 'prikaziLicnoIme', 'tipKorisnika_idTipKorisnika', 'grad_idGrad', 'pol_idPol', 'slika'];
    /*
      OVO DODATI AKO create_time KOLONA NE FUNKCIONISE,
      ALI MYSQL BI TREBALO OVO AUTOMATSKI DA RADI
      protected $useTimestamps = true;
      protected $createdField  = 'create_time';
      protected $updatedField  = ''; // Ovo nemamo
      protected $deletedField  = ''; // Ni ovo nemamo
     */
    protected $validationRules = [
        'username' => 'required|alpha_dash|is_unique[korisnik.username]|min_length[4]',
        'email' => 'valid_email|is_unique[korisnik.email]|permit_empty',
        'password' => 'required|alpha_numeric_punct|min_length[6]',
        'licnoIme' => 'alpha_space|permit_empty',
        'tipKorisnika_idTipKorisnika' => 'required|integer|is_not_unique[tip_korisnika.idTipKorisnika]',
        'grad_idGrad' => 'integer|permit_empty|is_not_unique[grad.idGrad]',
        'pol_idPol' => 'integer|permit_empty|is_not_unique[pol.idPol]'
    ];
    protected $validationMessages = [
        'username' => [
            'required' => 'Morate uneti željeno korisničko ime.',
            'alpha_dash' => 'Korisničko ime sadrži nedozvoljen znak.',
            'is_unique' => 'To korisničko ime je već zauzeto.',
            'min_length' => 'Korisničko ime mora sadržati bar 4 karaktera.'
        ],
        'email' => [
            'valid_email' => 'Email adresa nije u dobrom formatu.',
            'is_unique' => 'Ta e-mail adresa je vec zauzeta.',
        ],
        'password' => [
            'required' => 'Morate uneti željenu šifru.',
            'alpha_numeric_punct' => 'Šifra sadrži nedozvoljene znake.',
            'min_length' => 'Šifra mora sadržati makar 6 karaktera.',
        ],
        'licnoIme' => [
            'alpha_space' => 'Lično ime sadrži nedozvoljene znake.',
        ],
        'tipKorisnika_idTipKorisnika' => [
            'required' => 'Programska greška, tip korisnika nije dat.',
            'is_not_unique' => 'Programska greška, tip korisnika ne postoji.',
        ],
        'grad_idGrad' => [
            'is_not_unique' => 'Programska greška, grad ne postoji.',
        ],
        'pol_idPol' => [
            'is_not_unique' => 'Programska greška, pol ne postoji.',
        ],
    ];
    protected $skipValidation = false;
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
        
        public function updateKorisnik($idKorisnika, $idSeanse) {
            $data = [
                'korisnik_idKorisnik' => $idKorisnika,
                'seansa_idSeansa' => $idSeanse
            ];
            $this->insert($data);
        }
        
}

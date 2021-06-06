<?php

namespace App\Models;

use CodeIgniter\Model;

class TipKorisnikaModel extends Model {
    // Konstante za pristup
    const korisnikNaziv = 'Korisnik';
    const psihologNaziv = 'Psiholog';
    const administratorNaziv = 'Administrator';
    
    protected $table = 'tip_korisnika';
    protected $primaryKey = 'idTipKorisnika';
    protected $returnType = 'object';
    
    // Vraca ID  tipaobicnog korisnika
    public function getKorisnikId() {
        return $this->where('tip', self::korisnikNaziv)->first()->idTipKorisnika;
    }
    
    // Vraca ID tipa psihologa
    public function getPsihologId() {
        return $this->where('tip', self::psihologNaziv)->first()->idTipKorisnika;
    }
    
    // Vraca ID tipa administratora
    public function getAdminId() {
        return $this->where('tip', self::administratorNaziv)->first()->idTipKorisnika;
    }
    
}

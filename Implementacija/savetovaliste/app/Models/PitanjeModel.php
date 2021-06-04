<?php namespace App\Models;

use CodeIgniter\Model;
use App\Models\TipKorisnikaModel;

class PitanjeModel extends Model
{
        protected $table      = 'pitanje';
        protected $primaryKey = 'idPitanje';
        protected $allowedFields = ['korisnik_idKorisnik_postavio', 'kategorijaPitanja_idKategorija', 'naslovPitanja', 
                                    'tekstPitanja','postavljenoAnonimno','moguSviDaOdgovore'];
        protected $returnType = 'object';
        
        // prikazu svih pitanja koja odgovaraju pretrazi
        // radi boljih rezultata prikazuju se i pitanja koja sadrze trazenu rec u razlicitim padezima
        public function pretraga_pitanja($tekst){
            if($tekst=="porodični problemi")
            {
                return $this->like('naslovPitanja',"porodica")->orlike('tekstPitanja',"porodica")->
                orlike('naslovPitanja',"problemi u porodici")->orlike('tekstPitanja',"problemi u porodici")->
                orlike('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->findAll();
            }

            if($tekst=="napad panike")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"paničnim")->orlike('naslovPitanja',"paničnim")->
                orlike('tekstPitanja',"panika")->orlike('naslovPitanja',"panika")->
                orlike('tekstPitanja',"napadi panike")->orlike('naslovPitanja',"napadi panike")->
                orlike('naslovPitanja',"panike")->orlike('tekstPitanja',"panike")->findAll();
            }

            if($tekst=="anksioznost")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"anksiozan")->orlike('naslovPitanja',"anksiozan")->
                orlike('tekstPitanja',"anksioznosti")->orlike('naslovPitanja',"anksioznosti")->
                orlike('tekstPitanja',"anksiozna")->orlike('naslovPitanja',"anksiozna")->
                orlike('naslovPitanja',"anksiozni")->orlike('tekstPitanja',"anksiozni")->findAll();
            }

            if($tekst=="depresija")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"depresivan")->orlike('naslovPitanja',"depresivan")->
                orlike('tekstPitanja',"depresivna")->orlike('naslovPitanja',"depresivna")->
                orlike('tekstPitanja',"depresivni")->orlike('naslovPitanja',"depresivni")->
                orlike('naslovPitanja',"depresijom")->orlike('tekstPitanja',"depresijom")->findAll();
            }

            if($tekst=="kontrola stresa")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"stres")->orlike('naslovPitanja',"stres")->
                orlike('tekstPitanja',"stresno")->orlike('naslovPitanja',"stresno")->
                orlike('tekstPitanja',"stresira")->orlike('naslovPitanja',"stresira")->
                orlike('tekstPitanja',"kontrolišem stres")->orlike('naslovPitanja',"kontrolišem stres")->
                orlike('tekstPitanja',"kontrolisala stres")->orlike('naslovPitanja',"kontrolisala stres")->
                orlike('tekstPitanja',"kontrolisao stres")->orlike('naslovPitanja',"kontrolisao stres")->findAll();
            }

            if($tekst=="kontrola besa")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"bes")->orlike('naslovPitanja',"bes")->
                orlike('tekstPitanja',"besan")->orlike('naslovPitanja',"besan")->
                orlike('tekstPitanja',"besna")->orlike('naslovPitanja',"besna")->
                orlike('tekstPitanja',"kontrolišem bes")->orlike('naslovPitanja',"kontrolišem bes")->
                orlike('tekstPitanja',"kontrolisala bes")->orlike('naslovPitanja',"kontrolisala bes")->
                orlike('tekstPitanja',"kontrolisao bes")->orlike('naslovPitanja',"kontrolisao bes")->findAll();
            }

            if($tekst=="manjak samopouzdanja")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"samopouzdanje")->orlike('naslovPitanja',"samopouzdanje")->
                orlike('tekstPitanja',"samopouzdanja")->orlike('naslovPitanja',"samopouzdanja")->findAll();
            }

            
            if($tekst=="OKP")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"opsesivno kompulzivni poremećaj")->orlike('naslovPitanja',"opsesivno kompulzivni poremećaj")->findAll();
            }

            if($tekst=="depersonalizacija")
            {
                return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->
                orlike('tekstPitanja',"depersonalizacije")->orlike('naslovPitanja',"depersonalizacije")->findAll();
            }

             return $this->like('naslovPitanja',$tekst)->orlike('tekstPitanja',$tekst)->findAll();
        }

        // prikaz svih pitanja koja odgovaraju odredjenoj kategoriji ciji id je prosledjen
        public function pregled_pitanja_po_kategoriji($idKategorija){
            return $this->where('kategorijaPitanja_idKategorija',"$idKategorija")->findAll();
        }        
}
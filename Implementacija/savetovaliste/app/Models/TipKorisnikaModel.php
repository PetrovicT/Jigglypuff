<?php namespace App\Models;

use CodeIgniter\Model;

class TipKorisnikaModel extends Model
{
        protected $table      = 'tip_korisnika';
        protected $primaryKey = 'idTipKorisnika';
        protected $returnType = 'object';
}
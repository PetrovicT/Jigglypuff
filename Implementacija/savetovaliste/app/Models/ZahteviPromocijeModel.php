<?php namespace App\Models;

use CodeIgniter\Model;

class ZahteviPromocijeModel extends Model
{
        protected $table      = 'zahtevi_promocije';
        protected $primaryKey = 'idKorisnika';
        protected $returnType = 'object';

        protected $useAutoIncrement = false;

        // Ništa, nema menjanja, osim iz PhpMyAdmina
        protected $allowedFields = ['idKorisnika', 'path'];
}

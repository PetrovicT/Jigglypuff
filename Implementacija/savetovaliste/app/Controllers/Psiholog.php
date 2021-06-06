<?php

namespace App\Controllers;

class Psiholog extends Korisnik
{
        public function organizovane_seanse(){
            echo view('moje_seanse');
        }
}
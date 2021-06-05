<?php

namespace App\Controllers;

class Korisnik extends BaseController
{
	public function index()
	{
		echo view("pocetna_stranica");
		//return view('welcome_message');
	}

	// prikaz profila korisnika ciji smo id prosledili 
	public function profil($userId){
    echo view("profil");

	}
}

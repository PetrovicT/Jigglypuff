<?php

namespace App\Controllers;

class Administrator extends Korisnik
{
	public function index()
	{
		return view('welcome_message');
	}
}
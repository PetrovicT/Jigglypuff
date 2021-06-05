<?php

namespace App\Controllers;

class Korisnik extends BaseController
{
	public function index()
	{
		echo view("pocetna_stranica");
		//return view('welcome_message');
	}
        
        public function prijavi_seansu(){
            if(!$this->request->isAJAX()){
                die();
            }
            
            $response=[
                'odgovor' => 'Neki odgovor od servera...'
            ];
            
            return $this->response->setJSON($response);
        }
}

<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PitanjeModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['url', 'form'];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		$this->session = session();
	}

	 // Stranica za pregled pitanja, ne funkcionalnost pregleda pitanja
	 public function pregled_pitanja_stranica($poruka = null){
        echo view("pregled_pitanja", ['pregled_pitanjaErrorMessage' => $poruka]);
    }

    public function pregled_pitanja(){
         $pitanjeModel=new PitanjeModel();
         $pitanja=$pitanjeModel->findAll();
         $this->prikaz('pregled_pitanja', ['pitanja'=>$pitanja]);
    }

	public function pretraga_pitanja(){
		$pitanjeModel=new PitanjeModel();
		$pitanja=$pitanjeModel->pretraga_pitanja($this->request->getVar('pretraga'));
		$this->prikaz('pregled_pitanja', ['pitanja'=>$pitanja,'trazeno'=>$this->request->getVar('pretraga')]);
	}
}

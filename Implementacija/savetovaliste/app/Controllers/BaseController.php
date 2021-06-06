<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\PitanjeModel;
use App\Models\KorisnikModel;
use App\Models\OdgovorModel;
use App\Models\KategorijaPitanjaModel;
use App\Models\SeansaModel;

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
class BaseController extends Controller {

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
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger) {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        //--------------------------------------------------------------------
        // Preload any models, libraries, etc, here.
        //--------------------------------------------------------------------
        $this->session = session();
        if (!$this->session->get('controller')) {
            $this->session->set('controller', 'Gost');
        }
    }

    // prikazuju se sva pitanja koja postoje u bazi
    public function pregled_pitanja() {
        $pitanjeModel = new PitanjeModel();
        $pitanja = $pitanjeModel->findAll();
        echo view("pregled_pitanja", ['pitanja' => $pitanja]);
    }

    // prikazuju se pitanja koja odgovaraju pretrazi
    public function pretraga_pitanja() {
        $pitanjeModel = new PitanjeModel();
        if ($this->request->getVar('pretraga')==null)  $pitanja=$pitanjeModel->findAll();
        else $pitanja = $pitanjeModel->pretraga_pitanja($this->request->getVar('pretraga'));
        echo view("pregled_pitanja", ['pitanja' => $pitanja, 'trazeno' => $this->request->getVar('pretraga')]);
    }

    // prikazuju se sva pitanja koja pripadaju odredjenoj kategoriji
     // posto se prosledjuje funkciji naziv kategorije, prvo se pronalazi id kategorije 
     // zatim se dohvataju sva pitanja koja pripadaju toj kategoriji (u pitanjima se cuva id kategorije)
    public function pregled_pitanja_po_kategoriji() {
        $pitanjeModel = new PitanjeModel();
        $kategorijaPitanjaModel = new KategorijaPitanjaModel();
        if ($this->request->getVar('pretraga')==null)  $pitanjaK=$pitanjeModel->findAll();
        else  // ako nije uneta nijedna kategorija onda prikazi sva pitanja
        {
            $kategorijaId = $kategorijaPitanjaModel->findQuestionCategoryId($this->request->getVar('pretraga'));
            $pitanjaK = $pitanjeModel->pregled_pitanja_po_kategoriji($kategorijaId);
        }
        echo view("pregled_pitanja", ['pitanja' => $pitanjaK]);
    }

    // prikazuju se svi odgovori na odredjeno pitanje
    public function pregledOdgovora() {
        $odgovorModel = new OdgovorModel();
        $pitanjeModel = new PitanjeModel();
        if ($this->request->getVar('pretraga')==null)  return redirect()->to(site_url('/'));
        else {
        $pitanjeId = $this->request->getVar('pretraga');
        $odgovori = $odgovorModel->pregledOdgovoraNaPitanje($pitanjeId);
        $pitanje = $pitanjeModel->find($pitanjeId);
        echo view("odgovori", ['odgovori' => $odgovori, 'pitanje' => $pitanje]);
        }
    }
    
    public function pregled_seansi(){
        $seansaModel = new SeansaModel();
        $sveSeanse = [];
        
        if($this->request->getGet('samoMoje') && $this->session->get('userid')){
            $sveSeanse = $seansaModel->findAllWithParticipant($this->session->get('userid'));
        }
        else if($this->request->getGet('datumSeanse')){
            $sveSeanse = $seansaModel->findAllOnDateSorted($this->request->getGet('datumSeanse'));
        }
        else if($this->request->getGet('pretraga')){
            $sveSeanse = $seansaModel->findAllInFutureSortedLike($this->request->getGet('pretraga'));
        }
        else{
            $sveSeanse = $seansaModel->findAllInFutureSorted();
        }
        echo view("view_seanse", ['sveSeanse' => $sveSeanse]);
    }

    /*
    // ako zelimo nesto da uradimo pre svakog prikaza
    protected function prikaz($page, $data){
		$data['controller']='BaseController';
        echo view("$page", $data);
	}
    */
    
    public function logout() {
        $this->session->destroy();
        return redirect()->to(site_url());
    }

    // prikaz profila korisnika ciji smo id prosledili 
	public function profil($idKorisnika=null){
        // ako pozovemo bez parametara
        if ($idKorisnika==null) return redirect()->to(site_url('/'));
        // ako pokusamo da pregledamo profil korisnika ciji id nije u bazi 
        $korisnikModel=new KorisnikModel();
        $korisnik = $korisnikModel->find($idKorisnika);
        if ($korisnik == null) {
            return redirect()->to(site_url('/'));
        }
		echo view("profil", ['idKorisnikaCijiProfilGledamo'=>$idKorisnika]);
			return;
	}
}

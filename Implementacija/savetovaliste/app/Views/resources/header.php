<?php

use App\Models\KategorijaPitanjaModel;

$controller = session()->get('controller');

// Ovo treba za svaki header
$kategorijaPitanjaModel = new KategorijaPitanjaModel();
$sveKategorijePitanja = $kategorijaPitanjaModel->findAll();

if($controller){
    require_once 'header_'.$controller.'.php';
}
else{
    // Za svaki slučaj, ako negde propustimo da stavimo controller
    require_once 'header_Gost.php';
}
    

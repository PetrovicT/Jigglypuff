<?php

if(session()->get('controller')){
    require_once 'header_'.session()->get('controller').'.php';
}
else{
    // Za svaki slučaj, ako negde propustimo da stavimo controller
    require_once 'header_Gost.php';
}
    

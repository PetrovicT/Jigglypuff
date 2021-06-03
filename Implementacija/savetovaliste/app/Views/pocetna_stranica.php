
<!-- Petrovic Teodora -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>/photos/logo.png" />
        <link rel="stylesheet" href="/css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/pitanja.css">
         <link rel="stylesheet" href="<?php echo base_url(); ?>/css/pocetna.css">
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}</style>
        <script src = "<?php echo base_url(); ?>/js/script.js"></script>
          <title>Homepage</title> 
    </head>

    <body class="w3-light-grey">

        <!-- Header -->
        <?php
            require 'resources/header.php';
        ?>

        <div class="w3-content" style="max-width:85%; padding-top: 0; ">

            <!-- POZADINA -->
            <div class="w3-row w3-padding w3-border sky " 
                 style="background-image: url(<?php echo base_url(); ?>/photos/sky3.jpg); background-repeat: no-repeat; background-attachment: fixed;"> 

                <!-- UNOSI -->
                <div class="w3-col l12 s12" style="padding-left: 5%; padding-right: 5%;">
                <br>
                    <!-- UNOS -->
                    <div class="w3-container w3-white w3-margin w3-padding-large w3-card-4">
                        <div class="w3-center letters_dark_blue" style="font-size: 30px;">
                            Dobrodošli na veb portal za psihološko savetovanje!
                            <br>
							
                          <img src="<?php echo base_url(); ?>/photos/logo.png" alt="">
                        </div>

                        <!-- LINK LOGIN/REGISTRACIJA -->
                        <div class=" w3-left">
                            <div class="overlay letters_dark_blue" style="font-size: 28px;"><i class="fa fa-user"></i> Već imate nalog?
                                <a href="<?= site_url("Gost/login") ?>">LOGIN</a></div>
                            <div class="overlay letters_dark_blue" style="font-size: 28px; color: #021B79;"><i class="fa fa-user"></i>
                                Nemate nalog?  <a href="<?= site_url("Gost/register") ?>">REGISTRUJ SE</a></div>
                            <br>
                        </div>
                    </div>
                    <hr>

                    <!-- PRETRAGA -->
                     
                    <div class="w3-container w3-center w3-white w3-margin w3-padding-large w3-card-4">
                           
                        <div id="SearchBar" style="width:100%; max-width: 100%; padding-top: 30px; padding-bottom: 20px; border-color: #021B79;">                                                
                        <form name="pretraga_pitanja"  action="<?= site_url("$controller/pretraga_pitanja") ?>">                         
                        <input id="SearchField" class="w3-bar-item w3-center letters_dark_blue" type="text"
                                   placeholder="Pretraži..." style="width: 40%;" name="pretraga">
                        <button type="submit" id="search_pocetna" class="fa fa-search letters_dark_blue" style="font-size: 20px;" value="Pretrazi"   > <br>
                        </form>
                        </div>                                

                        <hr style="border-top-color: #021B79;">

                        <div class="w3-center w3-white">
                            <div class=" w3-white" style="padding-left: 10%; padding-right: 10%; width: 100%; align-items: center;">

                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=anksioznost") ?>">Anksioznost</a>
                            </span>  
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=depresija") ?>">Depresija</a>
                            </span> 
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=napad%20panike") ?>">Napad panike</a>
                            </span> 
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=kontrola%20stresa") ?>">Kontrola stresa</a>
                            </span> 
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=kontrola%20besa") ?>">Kontrola besa</a>
                            </span> 
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=porodicni%20problemi") ?>">Porodični problemi</a>
                            </span> 
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=manjak%20samopouzdanja") ?>">Manjak samopouzdanja</a>
                            </span> 
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=OKP") ?>">OKP</a>
                            </span> 
                            <span class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=depersonalizacija") ?>">Depersonalizacija</a>
                            </span> 
                                
                            </div>
                        </div>
                    </div>
                    <hr>

                    <!-- SLIKE -->
                    <div class="w3-container w3-white w3-margin w3-padding-large w3-card-4"
                         style="padding-top: 5%; padding-bottom: 5%;">
                        <div class="w3-center letters_dark_blue">
                            <h3 style="font-size: 26px;">Pogledajte neke od najčešćih simptoma: </h3>
                        </div>
                    </div>
                    <br>

                    <!-- RED OD 3 SLIKE -->
                    <div class="w3-row-padding">
                        <div class="w3-col s4">
							<img src="<?php echo base_url(); ?>/photos/NEW/panic_atack.jpg" alt="" style="width:100%;">                       
                           <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=napad%20panike") ?>"> <p class="card_text">NAPAD PANIKE</p></a>
                        </div>

                        <div class="w3-col s4">
							<img src="<?php echo base_url(); ?>/photos/new/ocd.png" alt="" style="width:100%;">  
                            <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=OKP") ?>"> <p class="card_text">OKP</p></a>
                        </div>

                        <div class="w3-col s4">
                       	<img src="<?php echo base_url(); ?>/photos/NEW/shape.jpg" alt="" style="width:100%;"> 
                           <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=porodični%20problemi") ?>"> <p class="card_text">PORODIČNI PROBLEMI</p></a>
                        </div>
                    </div>

                    <br>
                    <br>

                    <!-- RED OD 3 SLIKE -->
                    <div class="w3-row-padding">

                        <div class="w3-col s4">
                            	<img src="<?php echo base_url(); ?>/photos/NEW/angrer.png" alt="" style="width:100%;"> 
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=kontrola%20besa") ?>"> <p class="card_text">KONTROLA BESA</p></a>
                        </div>

                        <div class="w3-col s4">
                            	<img src="<?php echo base_url(); ?>/photos/NEW/stress.png" alt="" style="width:100%;"> 
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=kontrola%20stresa") ?>"> <p class="card_text">KONTROLA STRESA</p></a>
                        </div>

                        <div class="w3-col s4">
                            	<img src="<?php echo base_url(); ?>/photos/NEW/depersonalisation.jpg" alt="" style="width:100%;"> 
                                <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=depersonalizacija") ?>"> <p class="card_text">DEPERSONALIZACIJA</p></a>
                        </div>
                    </div>

                    <br>
                    <br>

                    <!-- RED OD 3 SLIKE -->
                    <div class="w3-row-padding">

                        <div class="w3-col s4">
                        <img src="<?php echo base_url(); ?>/photos/NEW/depresija.png" alt="" style="width:100%;">
                        <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=depresija") ?>"> <p class="card_text">DEPRESIJA</p></a>
                        </div>

                        <div class="w3-col s4">
                            <img src="<?php echo base_url(); ?>/photos/NEW/samopouzdanje.jpg" alt="" style="width:100%;">
                            <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=manjak%20samopouzdanja") ?>"> <p class="card_text">MANJAK SAMOPOUZDANJA</p></a>

                        </div>
                        <div class="w3-col s4">
						<img src="<?php echo base_url(); ?>/photos/NEW/anxiety.png" alt="" style="width:100%;">
                        <a class="nema_podvlacenja" href="<?= site_url("$controller/pretraga_pitanja?pretraga=anksioznost") ?>"> <p class="card_text">ANKSIOZNOST</p></a>
                        </div>
                    </div>

                    <br> <br>
                    <hr>
                    <br>

                    <!-- CITATI -->
                    <div class="w3-panel w3-leftbar w3-white w3-margin w3-padding-large">
                        <p class="w3-xxlarge letters_dark_blue" style="padding-right: 12px;"><i style="font-size: 34px;">"Život nema nikakvog smisla bez
                                međuzavisnosti. Potrebni smo jedni drugima i što pre to naučimo, tim bolje za sve nas."</i></p>
                        <p class="letters_dark_blue" style="font-size: 22px;">Erik Erikson</p>
                    </div>

                    <div class="w3-panel w3-leftbar w3-white w3-margin w3-padding-large">
                        <p class="w3-xxlarge  letters_dark_blue" style="padding-right: 12px;"><i style="font-size: 34px;">"Mi smo ono što jesmo jer smo bili
                                ono što smo bili i ono što je potrebno za rešavanje problema ljudskog života i motiva nisu moralne procene
                                već više znanja."</i></p>
                        <p class="letters_dark_blue " style="font-size: 22px;">Zigmund Freud</p>
                    </div>

                    <hr>
                    <!-- KRAJ UNOSI -->
                </div>

                <br>
                <!-- KRAJ POZADINA -->
            </div>
            <!-- KRAJ SADRZAJ -->
        </div>

        <?php
        require 'resources/footer.php';
        ?>
    </body>

</html>

<!-- Petrovic Teodora -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="photos/logo.png" />
        <link rel="stylesheet" href="css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/pitanja.css">
        <link rel="stylesheet" href="css/pocetna.css">
        <title>Homepage</title>
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"}  body {font-family: "Oswald"} </style>
        <script src="js/script.js"></script>
    </head>

    <body class="w3-light-grey">

        <!-- Header -->
        <?php
        require 'resources/header.php';
        ?>

        <div class="w3-content" style="max-width:85%; padding-top: 0; ">

            <!-- POZADINA -->
            <div class="w3-row w3-padding w3-border sky " 
                 style="background-image: url(photos/sky3.jpg); background-repeat: no-repeat; background-attachment: fixed;"> 

                <!-- UNOSI -->
                <div class="w3-col l12 s12" style="padding-left: 5%; padding-right: 5%;">

                    <!-- UNOS -->
                    <div class="w3-container w3-white w3-margin w3-padding-large w3-card-4">
                        <div class="w3-center letters_dark_blue" style="font-size: 30px;">
                            Dobrodošli na veb portal za psihološko savetovanje!
                            <br>
                            <img src="photos/logo.png" alt="">
                        </div>

                        <!-- TODO: Ako je korisnik već ulogovan, ispisati dobrodošlicu i ponuditi logout umesto ovoga. -->
                        <!-- LINK LOGIN/REGISTRACIJA -->
                        <div class=" w3-left">
                            <div class="overlay letters_dark_blue" style="font-size: 28px;"><i class="fa fa-user"></i> Već imate nalog?
                                <a href="logovanje.html">LOGIN</a></div>
                            <div class="overlay letters_dark_blue" style="font-size: 28px; color: #021B79;"><i class="fa fa-user"></i>
                                Nemate nalog? <a href="registracija.html">REGISTRUJ SE</a></div>
                            <br>
                        </div>
                    </div>
                    <hr>

                    <!-- PRETRAGA -->
                    <div class="w3-container w3-center w3-white w3-margin w3-padding-large w3-card-4">
                        <div id="SearchBar"
                             style="width:100%; max-width: 100%; padding-top: 30px; padding-bottom: 20px; border-color: #021B79;">
                            <input id="SearchField" class="w3-bar-item w3-center letters_dark_blue" type="text"
                                   placeholder="Pretraži..." style="width: 40%;">
                            <a href="pregled_pitanja.html" class="w3-bar-item w3-button "><i class="fa fa-search letters_dark_blue"
                                                                                             style="font-size: 20px; "></i></a>
                        </div>

                        <hr style="border-top-color: #021B79;">

                        <div class="w3-center w3-white">
                            <div class=" w3-white" style="padding-left: 10%; padding-right: 10%; width: 100%; align-items: center;">
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Anksioznost</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Depresija</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Napad panike</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Kontrola stresa</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Kontrola besa</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Porodični problemi</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Manjak samopouzdanja</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">OKP</span>
                                <span onclick="window.location.href = 'pregled_pitanja.html';"
                                      class="w3-tag category w3-margin-bottom w3-xlarge w3-card-4">Depersonalizacija</span>
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
                            <img src="photos/NEW/panic_atack.jpg" style="width:100%;">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">NAPAD PANIKE</p>
                        </div>

                        <div class="w3-col s4">
                            <img src="photos/new/ocd.png" style="width:100%;">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">OKP</p>
                        </div>

                        <div class="w3-col s4">
                            <img src="photos/new/shape.jpg" style="width:100%; ">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">PORODIČNI PROBLEMI</p>
                        </div>
                    </div>

                    <br>
                    <br>

                    <!-- RED OD 3 SLIKE -->
                    <div class="w3-row-padding">

                        <div class="w3-col s4">
                            <img src="photos/new/angrer.png" style="width:100%">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">PROBLEMI SA BESOM</p>
                        </div>

                        <div class="w3-col s4">
                            <img src="photos/new/stress.png" style="width:100%">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">STRES</p>

                        </div>
                        <div class="w3-col s4">
                            <img src="photos/new/depersonalisation.jpg" style="width:100%">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">DEPERSONALIZACIJA</p>
                        </div>
                    </div>

                    <br>
                    <br>

                    <!-- RED OD 3 SLIKE -->
                    <div class="w3-row-padding">

                        <div class="w3-col s4">
                            <img src="photos/new/depresija.png" style="width:100%">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">DEPRESIJA</p>
                        </div>

                        <div class="w3-col s4">
                            <img src="photos/NEW/samopouzdanje.jpg" style="width:100%">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">MANJAK SAMOPOUZDANJA</p>

                        </div>
                        <div class="w3-col s4">
                            <img src="photos/new/anxiety.png" style="width:100%">
                            <p class="card_text" onclick="window.location.href = 'pregled_pitanja.html';">ANKSIOZNOST</p>
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

        <!-- Footer -->
        <?php
        require 'resources/footer.php';
        ?>

    </body>

</html>
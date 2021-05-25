
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
        <title>Pregled pitanja</title>
        <style>
            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: "Oswald"
            }

            body {
                font-family: "Open Sans"
            }
        </style>
        <script src="js/script.js"></script>
    </head>

    <body class="w3-light-grey">

        <!-- Header -->
        <?php
        require 'resources/header.php';
        ?>

        <div class="w3-content" style="max-width:90%">
            <!-- POZADINA -->
            <div class="w3-row  w3-padding w3-border">

                <!-- UNOSI -->
                <div class="w3-col l8 s12"> <br>

                    <!-- UNOS -->
                    <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4 ">
                        <div class="w3-left" style="padding-left: 5%;"> <br>
                            <h3 class="letters_dark_blue"><b>Problemi sa paničnim napadima</b></h3>
                        </div>

                        <div class="w3-right" style="padding-right: 6%;"> <br>
                            <h3 class="letters_dark_blue"><a href="profil.html" style="text-decoration: none;"><b>Autor: Marko Ivanović</b></a>
                            </h3>
                        </div>

                        <!-- TEKST PITANJA -->
                        <div class="input letters_dark_blue">
                            <p style="text-align: justify; font-weight: normal;">Jako dugo imam probleme sa paničnim napadima. Osećam stezanje u grlu sto je postalo baš problem sada,
                                uzimao sam lekove kao terapiju sto mi je psihijatar prepisao i sam sam prestao da ih uzimam. Smatrao sam da mi više ne trebaju. Prošle nedelje sam imao učestale napade. Imam fizicke probleme kao stezanje u grlu i bol srca. Kako da pomognem sam sebi? Da li je bolje posavetovati se sa stručnim licem ili da sam nastavim sa prethodnom terapijom?</p> <br>
                        </div>

                        <!-- DUGMAD -->
                        <div class="input ">  
                            <div id="like">
                                <div>
                                    <button class="w3-button buttons" onclick="likeFunction(this)"><b><i class="fa fa-thumbs-up"></i> <u onclick="alert('Povećali ste broj lajkova za 1')" style="text-decoration: none; font-weight: normal;">Korisno (16)</u></button> &nbsp
                                    <button class="w3-button buttons" onclick="likeFunction(this)"><b><i class="fa fa-thumbs-down"></i> <u onclick="alert('Povećali ste broj dislajkova za 1')" style="text-decoration: none;font-weight: normal;">Nije korisno (7)</u></button>
                                </div>

                                <div style="float: right;">
                                    <button onclick="window.location.href = 'odgovori.html';"style="font-weight: normal;" class="w3-button buttons"> Pogledaj
                                        odgovore</button> &nbsp
                                    <button onclick="window.location.href = 'odgovori.html#text_input';"
                                            class="w3-button buttons" style="font-weight: normal;">Odgovori</button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4 ">

                        <div class="w3-left" style="padding-left: 5%;"> <br>
                            <h3 class="letters_dark_blue"><b>Anksioznost</b></h3>
                        </div>

                        <div class="w3-right" style="padding-right: 6%;"> <br>
                            <h3 class="letters_dark_blue"><b>Autor: Anonimno</b></h3>
                        </div>

                        <!-- TEKST PITANJA -->
                        <div class="input letters_dark_blue">
                            <p style="text-align: justify; font-weight: normal;">Anksioznost je problem koji me muči već godinama. Pokušavala sam na razne načine da ga rešim, išla sam kod psihologa i psihijatra, ali nije bilo većih poboljšanja. Možda zato što nisam bila spremna da otvoreno govorim sa njima. Strah me je da podelim priču sa bliskim osobama, jer ne znam da li će me razumeti. Niko ne razume koliko truda ulažem u svakodnevne razgovore, ma koliko oni bili kratki. Plašim se raznih stvari i imam običaj da ruke perem više puta detaljno, da mi cela kuća bude sređena. Da li je ovo stvarno anksioznost ili može biti nešto drugo? Kome da se obratim?
                            </p> <br>
                        </div>

                        <!-- DUGMAD -->
                        <div class="input ">     
                            <div id="like">
                                <div>
                                    <button class="w3-button buttons" onclick="likeFunction(this)"><b><i class="fa fa-thumbs-up"></i> <u onclick="alert('Povećali ste broj lajkova za 1')" style="text-decoration: none; font-weight: normal;">Korisno (3)</u></button> &nbsp
                                    <button class="w3-button buttons" onclick="likeFunction(this)"><b><i class="fa fa-thumbs-down"></i> <u onclick="alert('Povećali ste broj dislajkova za 1')" style="text-decoration: none; font-weight: normal;">Nije korisno (11)</u></button>
                                </div>

                                <div style="float: right;">
                                    <button onclick="window.location.href = 'odgovori.html';" class="w3-button buttons" style="font-weight: normal;"> Pogledaj
                                        odgovore</button> &nbsp
                                    <button onclick="window.location.href = 'odgovori.html#text_input';"
                                            class="w3-button buttons" style="font-weight: normal;">Odgovori</button>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>

                    <!-- KRAJ UNOSI -->
                </div>

                <br>

                <!-- LITERATURA -->
                <div class="w3-col l4">
                    <div class="w3-white w3-margin w3-card-2">
                        <div class="w3-container w3-padding gradient_literature letters">
                            <h4>Preporučena literatura za sve ljubitelje psihologije</h4>
                        </div>
                        <ul class="w3-ul w3-hoverable w3-white">

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/50_ideja_koje_bi_stvarno_trebalo_da_znate_psihologija-adrijan_fernam_s.jpg"
                                             style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>50 ideja koje bi stvarno trebalo da znate - Adrijan Fernam</b></span> <br>
                                        <span style="font-weight: 500;"> Kolika je razlika između muškog i ženskog mozga? Postoji li zaista altruizam? Da li je naš um,
                                            odmah po rođenju, neispisana tablica?</span>

                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/bez_granica-dzim_kvik_s.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Bez granica - Džim Kvik</b></span> <br>
                                        <span style="font-weight: 500;">Usavršite svoj mozak, učite brže i otključajte pristup izuzetnom životu za koji ste
                                            sposobni.</span>
                                    </div>
                                </div>
                            </li>


                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/dete_u_tebi_mora_da_pronadje_svoj_zavicaj-stefani_stal_s.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Dete u tebi mora da pronađe svoj zavičaj - Štefani Štal</b></span> <br>
                                        <span style="font-weight: 500;">Ključ za rešavanje (skoro) svih problema. Svetski bestseler iz oblasti psihologije</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/emocionalni_prtljag-vivijan_ditmar_s.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Emocionalni prtljag - Vivijan Ditmar</b></span> <br>
                                        <span style="font-weight: 500;">Svako može, ako želi, da pronađe nešto dragoceno u ovoj knjizi i da naposletku nauči da se bolje
                                            nosi s negativnim emocijama.</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/izgubljene_veze-johan_hari_s.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Izgubljene veze - Johan Hari</b></span> <br>
                                        <span style="font-weight: 500;"> Naučnici širom sveta otkrili su dokaze za devet različitih uzroka depresije. Neki od njih su
                                            ukorenjeni u našoj biologiji, ali većina ih je u načinu na koji danas živimo.</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/sta_nam_svako_telo_govori-dzo_navaro_s.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Šta nam svako telo govori-Džo Navaro</b></span> <br>
                                        <span style="font-weight: 500;">Priručnik bivšeg agenta FBI-a za brzo „čitanje“ ljudi. Zašto je lice poslednje mesto na kojem
                                            treba tražiti znake iskrenih emocija?</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/vise_se_ne_razumemo-izabel_fijioza_v.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Više se ne razumemo - Izabel Fijioza</b></span> <br>
                                        <span style="font-weight: 500;">U knjizi Više se ne razumemo otkrićemo šta se dešava u glavi i telu naših tinejdžera.</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="photos/borba_do_pobede_knjiga_za_sve_one_kojima_je_tesko-srdjan_krstic_v.jpg"
                                             style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Borba do pobede - Srđan Krstić</b></span> <br>
                                        <span style="font-weight: 500;">Ova knjiga je napisana s namerom da pomogne ljudima kojima je teško, onima koji ne vide
                                            izlaz.</span>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                    <hr>

                    <!-- KRAJ LITERATURA -->
                </div>

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
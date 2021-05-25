
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
        <title>Postavi pitanje</title>
        <style>
            h1,h2,h3,h4,h5,h6 {
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
                <div class="w3-col l8 s12">
                    <br>

                    <!-- UNOS -->
                    <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4 ">

                        <div class="w3-left" style="padding-left: 5%;"> <br>
                            <h3 class="letters_dark_blue"><b>Saveti i preporuke prilikom postavljanja pitanja</b></h3>
                        </div>

                        <br>
                        <div class="w3-left letters_dark_blue" style="padding-left: 5%; padding-right: 6%; font-weight: bold;">
                            <ol>
                                <li>Pre nego što postavite pitanje proverite da li je neko drugi ranije postavio isto ili slično pitanje
                                </li>
                                <li>Prilikom formulacije pitanja trudite se da pitanje bude što jasnije i preciznije</li>
                                <li>Pre nego što pošaljete pitanje pročitajte ga još jednom i ispravite eventualne greške</li>
                                <li>Vodite računa da je podrazumevano javno postavljanje pitanja. Ukoliko želite da anonimno postavite
                                    pitanje, molimo Vas da to i naznačite u odgovarajućem polju.</li>
                            </ol>

                            <hr style="border-top-color: #021B79;">
                        </div>

                        <div class="w3-left" style="padding-left: 5%;">
                            <h3 class="letters_dark_blue"><b>Postavi pitanje</b></h3>
                        </div>

                        <br>
                        <div class="input letters_dark_blue">
                            <h4 class="letters_dark_blue">Izaberite kategoriju pitanja</h4>

                            <form action="">
                                <label for="category"></label>
                                <select style="color: #021B79; border-color: #021B79; font-size: 16px; width: 100%;" name="category" id="category" required oninvalid="this.setCustomValidity('Izaberite kategoriju pitanja!')"
                                        oninput="this.setCustomValidity('')">
                                    <option style="color: #021B79;" value="">-</option>
                                    <option style="color: #021B79;" value="">Anksioznost</option>
                                    <option style="color: #021B79;" value="">Depresija</option>
                                    <option style="color: #021B79;" value="">Panični napadi</option>
                                    <option style="color: #021B79;" value="">Kontrola stresa</option>
                                    <option style="color: #021B79;" value="">Problemi sa besom</option>
                                    <option style="color: #021B79;" value="">Porodični problemi</option>
                                    <option style="color: #021B79;" value="">Manjak samopouzdanja</option>
                                    <option style="color: #021B79;" value="">Ništa od ponuđenog</option>
                                </select>
                                <br><br>


                                <!-- UNOS PITANJA -->
                                <input style="color: #021B79; border-color: #021B79; font-size: 16px; " class="w3-input" type="text"
                                       placeholder="Naslov pitanja" required oninvalid="this.setCustomValidity('Unesite naslov pitanja!')"
                                       oninput="this.setCustomValidity('')"> <br> <br>
                                <textarea style="color: #021B79; border-color: #021B79; font-size: 16px; resize: none; width: 100%;" name="" id=""
                                          cols="355" rows="10" placeholder=" Tekst pitanja" required oninvalid="this.setCustomValidity('Unesite tekst pitanja!')"
                                          oninput="this.setCustomValidity('')"></textarea>
                                <br>

                                <!-- JAVNO/PRIVATNO -->
                                <div><input type="checkbox" id="anonimus" name="anonimus" value="Bike">
                                    <label for="anonimus" style="color: #021B79; font-size: 16px; font-weight: bold; "> Želim anonimno da postavim
                                        pitanje</label>
                                </div>
                                <br>

                                <!-- KO ODGOVARA -->
                                <h4>Na ovo pitanje će moći da odgovore &nbsp&nbsp</h4>
                                <select style="color: #021B79; border-color: #021B79; font-size: 16px; " name="anwser">
                                    <option value="">Svi korisnici</option>
                                    <option value="">Samo psiholozi</option>
                                </select>
                                <br>
                                <br>
                                <!-- DUGMAD -->
                                <div>

                                    <div style="float: right;">
                                        <button onclick="window.location.href = 'pocetna_stranica.html';" class="w3-button buttons">
                                            Odustani</button> &nbsp
                                        <button type="submit" class="w3-button buttons"><u onclick="alert('Pitanje je poslato!')" style="text-decoration: none; font-weight: normal;">Pošalji</u></button>
                                    </div>
                                </div>

                                <br>
                                </div>
                            </form>
                        </div>

                        <!-- KRAJ UNOSA -->
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
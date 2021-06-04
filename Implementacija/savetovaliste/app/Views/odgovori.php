
<!-- Petrovic Teodora -->

<!DOCTYPE html>
<html>

<head>	
	 <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>/photos/logo.png" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/pitanja.css">
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}</style>
        <script src = "<?php echo base_url(); ?>/js/script.js"></script>
        <title>Odgovori</title>
  </head>


<body class="w3-light-grey">

    <?php
        require 'resources/header.php';
    ?>

  <div class="w3-content" style="max-width:90%">
    <?php
        $controller=session()->get('controller');
    ?>

    <!-- POZADINA -->
    <div class="w3-row  w3-padding w3-border">

      <!-- UNOSI -->
    <div class="w3-col l8 s12">
    <br>
    
    <?php 
    use App\Models\KorisnikModel;
    use App\Models\PitanjeModel;
    use App\Models\OdgovorModel;
    use App\Models\KorisnikOcenioOdgovorModel;
    use App\Models\KorisnikOcenioPitanjeModel;
        
    // bez obzira da li ima ili nema odgovora uvek se radi prikaz pitanja, pa zatim ili obavestenje da nema odgovora ili prikaz odgovora
    // na koje pitanje se traze odgovori
    $idPitanja=$pitanje->idPitanje;
    $korisnikOcenioPitanjeModel=new KorisnikOcenioPitanjeModel();
    // prikaz broja like i dislike na pitanju za koje se prikazuju odgovori
    $likes=$korisnikOcenioPitanjeModel->findNumOfLikes($idPitanja);
    $dislikes=$korisnikOcenioPitanjeModel->findNumOfDislikes(($idPitanja));

    // ispis naslova pitanja
    echo '
    <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
        <!-- ispis da se radi o pitanju na koje zelimo da pogledamo odgovore -->
        <div class="w3-center" style="padding-right: 5%; padding-left: 5%;"> <br>
            <h3 class="letters_dark_blue" style="font-size: 26px;"><b>PITANJE</b></h3>
            <hr style="border-top-color: #021B79;">
        </div>

        <div class="w3-left" style="padding-left: 5%;"> 
            <h3 class="letters_dark_blue"> <b> ' . $pitanje->naslovPitanja . '   </b>  </h3>
        </div>
    ';   
    
    // ako je anonimno postavljeno pitanje napisi anonimno
    if($pitanje->postavljenoAnonimno==1)
    {
        echo '
            <div class="w3-right" style="padding-right: 6%;"> 
                <h3 class="letters_dark_blue"><b> ' . "Anonimno" . '</b></h3>
            </div> ';
    }
    else
    {
        // ako nije anonimno stavi autora pitanja
        $korisnikModel=new KorisnikModel();
        $idAutora=$pitanje->korisnik_idKorisnik_postavio;
        $autor=$korisnikModel->findUserUsername($idAutora);
        echo '
            <div class="w3-right" style="padding-right: 6%;"> 
                <h3 class="letters_dark_blue"><b>' . $autor . '</b></h3>
            </div>
        ';
    }
    
    echo '
        <div class="input letters_dark_blue">
            <p style="text-align: justify; font-weight: normal;"> ' . $pitanje->tekstPitanja . ' </p> 
        </div>
        ';

    // ako je kontroler gost nemoj da das opciju odgovori na pitanje (mogucnost da se napise odgovor na pitanje cije odgovore prikazujemo)
    if ($controller=='Gost')
    {
        echo '
            <br>
            <div class="input">     
                <div id="like">
                    <div>
                        <!-- TODO ubaciti lajkovanje za Gosta -->
                        <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-up"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Korisno (' . "$likes" . ')</u></button> &nbsp
                        <!-- TODO ubaciti lajkovanje za Gosta -->
                        <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-down"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Nije korisno (' . "$dislikes" . ')</u></button>
                    </div>
                </div>
            <br>
            </div>

        </div> <!-- Kraj div container -->
        ';
    }

    else {  // ako nije controller gost, nego korisnik onda daj i mogucnost odgovora na pitanje i lajkovanja
        $referenca4=site_url("$controller/odgovori_na_pitanje/$idPitanja");
        echo '
        <br>
        <div class="input">     
            <div id="like">
                <div>
                    <!-- TODO ubaciti lajkovanje za ulogovanog korisnika -->
                    <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-up"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Korisno (' . "$likes" . ')</u></button> &nbsp
                    <!-- TODO ubaciti lajkovanje za ulogovanog korisnika -->
                    <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-down"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Nije korisno (' . "$dislikes" . ')</u></button>
                </div>
        
                <button onclick="" class="w3-button buttons" style="font-weight: normal;"> 
                    <a class="nema_podvlacenja" href=' . "$referenca4" . '>Odgovori</a>
                </button>
            </div>
        <br>
        </div>

    </div> <!-- Kraj div container -->
    ';
    }
        // ako nema odgovora onda je potrebno ispisati korisniku da nema nijednog odgovora na pitanje
        if (count($odgovori)==0) {
            echo '
                <div class="w3-center"> 
                    <h3 class="letters_dark_blue"> 
                    <br>
                        <b> Nije pronađen nijedan odgovor na izabrano pitanje. </b>
                    </h3>
                </div>
            ';
        }
        else 
        {
            // ako postoje odgovori na izabrano pitanje ispisi sve odgovore
            $korisnikModel=new KorisnikModel();
            $pitanjeModel=new PitanjeModel();
            $odgovorModel=new OdgovorModel();
            $korisnikOcenioOdgovorModel=new KorisnikOcenioOdgovorModel();
            foreach ($odgovori as $odgovor) 
            {
                // naznaci da se radi o odgovoru
                echo '
                <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
                    <div class="w3-left" style="padding-left: 5%;"> <br>
                        <h3 class="letters_dark_blue"> <b> ODGOVOR  </b>  </h3>
                    </div>
                ';           
                if($odgovor->odgovorenoAnonimno==1)
                // ako je anonimno odgovoreno, napisi da je autor anoniman
                    {
                        echo '
                            <div class="w3-right" style="padding-right: 6%;"> <br>
                                <h3 class="letters_dark_blue"><b> ' . "Anonimno" . '</b></h3>
                            </div> ';
                    }
                else
                // ako nije anoniman autor odgovora, napisi njegov username
                    {
                        $idAutora=$odgovor->korisnik_idKorisnik_odgovorio;
                        $autor=$korisnikModel->findUserUsername($idAutora);
                        echo '
                            <div class="w3-right" style="padding-right: 6%;"> <br>
                                <h3 class="letters_dark_blue"><b>' . $autor . '</b></h3>
                            </div>
                        ';
                    }
                echo '
                    <div class="input letters_dark_blue">
                        <p style="text-align: justify; font-weight: normal;"> ' . $odgovor->tekstOdgovora . ' </p> 
                        <br>
                    </div>
                ';

                //<!-- DUGMAD -->
                $idOdgovora=$odgovor->idOdgovor;
                $idPitanja=$pitanje->idPitanje;
                $likes=$korisnikOcenioOdgovorModel->findNumOfLikes($idOdgovora);
                $dislikes=$korisnikOcenioOdgovorModel->findNumOfDislikes(($idOdgovora));
                $referenca1=site_url("$controller/PostaviLike?pretraga=$idOdgovora");
                $referenca2=site_url("$controller/PostaviDislike?pretraga=$idOdgovora");
                $referenca4=site_url("$controller/odgovori_na_pitanje/$idPitanja");
                // ako je gost, nema mogucnost da like/dislike
                if ($controller=='Gost')
                {
                    echo '
                    <div class="input ">     
                        <div id="like">
                            <div>
                                <!-- TODO ubaciti lajkovanje za gosta -->
                                <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-up"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Korisno (' . "$likes" . ')</u></button> &nbsp
                                <!-- TODO ubaciti lajkovanje za gosta -->
                                <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-down"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Nije korisno (' . "$dislikes" . ')</u></button>
                            </div>                           
                        </div>
                    </div> 
                    <br>
                    </div>
                    '; 
                }
                else // ako nije gost nego korisnik ima mogucnost da like/dislike
                {
                    echo '
                    <div class="input ">     
                        <div id="like">
                            <div>
                                <!-- TODO ubaciti lajkovanje za ulogovanog korisnika -->
                                <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-up"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Korisno (' . "$likes" . ')</u></button> &nbsp
                                <!-- TODO ubaciti lajkovanje za ulogovanog korisnika -->
                                <button class="w3-button buttons" onclick=""><b><i class="fa fa-thumbs-down"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Nije korisno (' . "$dislikes" . ')</u></button>
                            </div>                           
                        </div>
                    </div> 
                    <br>
                    </div>
                    '; 
                }
            }
    }?>
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
										<img src="<?php echo base_url(); ?>/photos/50_ideja_koje_bi_stvarno_trebalo_da_znate_psihologija-adrijan_fernam_s.jpg"
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
                                        <img src="<?php echo base_url(); ?>/photos/bez_granica-dzim_kvik_s.jpg" style="width:100%;">
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
                                        <img src="<?php echo base_url(); ?>/photos/dete_u_tebi_mora_da_pronadje_svoj_zavicaj-stefani_stal_s.jpg" style="width:100%;">
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
                                        <img src="<?php echo base_url(); ?>/photos/emocionalni_prtljag-vivijan_ditmar_s.jpg" style="width:100%;">
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
                                        <img src="<?php echo base_url(); ?>/photos/izgubljene_veze-johan_hari_s.jpg" style="width:100%;">
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
                                        <img src="<?php echo base_url(); ?>/photos/sta_nam_svako_telo_govori-dzo_navaro_s.jpg" style="width:100%;">
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
                                        <img src="<?php echo base_url(); ?>/photos/vise_se_ne_razumemo-izabel_fijioza_v.jpg" style="width:100%;">
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
                                        <img src="<?php echo base_url(); ?>/photos/borba_do_pobede_knjiga_za_sve_one_kojima_je_tesko-srdjan_krstic_v.jpg"
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
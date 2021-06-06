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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src = "<?php echo base_url(); ?>/js/script.js"></script>
          <title>Pregled pitanja</title>
    </head>

    <body class="w3-light-grey">

    <!-- Header -->
    <?php
        require 'resources/header.php';
    ?>

    <div class="w3-content" style="max-width:90%">
    <!-- POZADINA -->
    <?php
        $controller=session()->get('controller');
    ?>
    <div class="w3-row  w3-padding w3-border">
            
    <div class="w3-col l8 s12"> <br>

 
    <?php 
    use App\Models\KorisnikModel;
    use App\Models\PitanjeModel;
    use App\Models\KorisnikOcenioPitanjeModel;

    // ako nema rezultata pretrage pitanja onda ispiši poruku korisniku 
        if (count($pitanja)==0) 
            echo '
                <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
                    <div class="w3-center"> 
                       <h3 class="letters_dark_blue"> 
                            <b> Nije pronađen nijedan rezultat. </b>
                        </h3>
                    </div>
                </div>
                ';
        else 
        {
            // ako postoje pitanja koja odgovaraju pretrazi ispiši svako u novoj kartici 
            $korisnikModel=new KorisnikModel();
            $pitanjeModel=new PitanjeModel();
            $korisnikOcenioPitanjeModel=new KorisnikOcenioPitanjeModel();

            foreach ($pitanja as $pitanje) 
            {
                echo '
                    <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
                        <div class="w3-left" style="padding-left: 5%;"> <br>
                            <h3 class="letters_dark_blue"> <b> ' . $pitanje->naslovPitanja . '   </b>  </h3>
                        </div>
                        ';   
                        
                        if($pitanje->postavljenoAnonimno==1)
                            {
                                echo '
                                <div class="w3-right" style="padding-right: 6%;"> <br>
                                    <h3 class="letters_dark_blue"><b> ' . "Anonimno" . '</b></h3>
                                </div> ';
                            }
                        else
                            {
                                $idAutora=$pitanje->korisnik_idKorisnik_postavio;
                                $autor=$korisnikModel->findUserUsername($idAutora);
                                $referencaPregledProfila=site_url("$controller/profil/$idAutora");
                                echo '
                                    <div class="w3-right" style="padding-right: 6%;"> <br>
                                    <a class="nema_podvlacenja" href=' . "$referencaPregledProfila" . '>
                                        <h3 class="letters_dark_blue"><b>' . $autor . '</b></h3>
                                    </a>                                        
                                    </div>
                                ';
                            }

                        // da li svi ili samo registrovani korisnici mogu da odgovore na pitanje
                        $sviImajuPravoDaOdgovore="Svi registrovani korisnici";
                        if ($pitanje->moguSviDaOdgovore==0) $sviImajuPravoDaOdgovore="Samo registrovani psiholozi";

                        echo '
                        <div class="input letters_dark_blue">
                        <p style="text-align: justify; font-weight: normal;"> <b> Na ovo pitanje mogu da odgovore: ' . $sviImajuPravoDaOdgovore . '</></p> 
                        </div>';

                        echo '

                        <div class="input letters_dark_blue">
                            <p style="text-align: justify; font-weight: normal;"> ' . $pitanje->tekstPitanja . ' </p> 
                            <br>
                        </div>
                        ';

                        // DUGMAD 
                        $idPitanja=$pitanje->idPitanje;
                        $likes=$korisnikOcenioPitanjeModel->findNumOfLikes($idPitanja);
                        $dislikes=$korisnikOcenioPitanjeModel->findNumOfDislikes(($idPitanja));
                        $referenca1=site_url("$controller/PostaviLike?pretraga=$idPitanja");
                        $referenca2=site_url("$controller/PostaviDislike?pretraga=$idPitanja");
                        $referenca3=site_url("$controller/pregledOdgovora?pretraga=$idPitanja");
                        $referenca4=site_url("$controller/odgovori_na_pitanje/$idPitanja");
                       
                        if ($controller=='Gost'){
                            echo '
                                <div class="input ">     
                                    <div id="like">
                                        <div>
                                            <button class="w3-button buttons" onclick="like_or_dislike_pitanje(this,'.$idPitanja.',1)"><i class="fa fa-thumbs-up"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">' . "$likes" . '</u></button> &nbsp
                                            <button class="w3-button buttons" onclick="like_or_dislike_pitanje(this,'.$idPitanja.',0)"><i class="fa fa-thumbs-down"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">' . "$dislikes" . '</u></button>
                                        </div>
                                                              
                                        <div style="float: right;">                                    
                                            <button onclick="" class="w3-button buttons" style="font-weight: normal;"> 
                                                <a class="nema_podvlacenja" href=' . "$referenca3" . '>Pogledaj odgovore</a>
                                            </button> &nbsp
                                           
                                        </div>  
                                                                    
                                    </div>
                                    <p style="color:red; text-align:left">Morate biti ulogovani da biste mogli da ocenite pitanje sa korisno/nije korisno!</p>
                                </div> 
                            ';
                        }
                        else {
                            echo '
                                <div class="input ">     
                                    <div id="like">
                                        <div>
                                        <button class="w3-button buttons" onclick="like_or_dislike_pitanje(this,'.$idPitanja.',1)"><i class="fa fa-thumbs-up"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">' . "$likes" . '</u></button> &nbsp
                                        <button class="w3-button buttons" onclick="like_or_dislike_pitanje(this,'.$idPitanja.',0)"><i class="fa fa-thumbs-down"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">' . "$dislikes" . '</u></button>
                                        </div>
                                
                                        <div style="float: right;">
                                            <button onclick="" class="w3-button buttons" style="font-weight: normal;"> 
                                                <a class="nema_podvlacenja" href=' . "$referenca3" . '>Pogledaj odgovore</a>
                                            </button> &nbsp
                                            <button onclick="" class="w3-button buttons" style="font-weight: normal;"> 
                                            <a class="nema_podvlacenja" href=' . "$referenca4" . '>Odgovori</a>
                                            </button>
                                        </div>
                                
                                    </div>
                                </div> 
                            ';
                        }
                        
                    echo '<br>
                    </div>
                    ';
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

        <?php
        require 'resources/footer.php';
        ?>
    </body>
</html>

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
        
    // prikaz pitanja na koje zelimo da damo odgovor
    $idPitanja=$pitanje->idPitanje;
    $korisnikOcenioPitanjeModel=new KorisnikOcenioPitanjeModel();
    // prikaz broja like i dislike na pitanju 
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
   
    $referencaOdgovori=site_url("$controller/pregledOdgovora?pretraga=$idPitanja");
    // prikaz teksta pitanja
    echo '
        <div class="input letters_dark_blue">
            <p style="text-align: justify; font-weight: normal;"> ' . $pitanje->tekstPitanja . ' </p> 
        </div>
        ';

    // prikaz broja lajkova i dislajkova 
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
    
            <div style="float: right;">                                    
            <button onclick="" class="w3-button buttons" style="font-weight: normal;"> 
                <a class="nema_podvlacenja" href=' . "$referencaOdgovori" . '>Pogledaj odgovore</a>
            </button> &nbsp
           
        </div> 
        </div>
    <br>
    </div>

    </div> <!-- Kraj div container -->
    ';
    
?>
       
  
    <?php  $idPitanja=$pitanje->idPitanje;  ?> 
    <form name="odgovoriNaPitanje"  action="<?= site_url("$controller/odgovoriNaPitanje/$idPitanja") ?>">
        <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4 ">

          <div class="w3-left" style="padding-left: 5%;"> <br>
            <h3 class="letters_dark_blue"><b>Saveti i preporuke prilikom odgovaranja na pitanja</b></h3>
          </div>

          <br>
          <div class="w3-left letters_dark_blue" style="padding-left: 5%; padding-right: 6%;">
            <ol>
              <li>Prilikom formulacije odgovora trudite se da odgovor bude što jasniji i precizniji</li>
              <li>Pre nego što pošaljete odgovor proverite da li je u skladu sa temom pitanja</li>
              <li>Ako niste verifikovani psiholog, molimo Vas da proverite da li imate mogućnost da odgovorite na
                postavljeno pitanje</li>
              <li>Vodite računa da je podrazumevano javno odgovaranje na pitanja. Ukoliko želite da anonimno odgovorite,
                molimo Vas da to i naznačite u odgovarajućem polju.</li>
              
            </ol>

            <hr style="border-top-color: #021B79;">
          </div>

          <div class="input ">

            <textarea name="TekstOdgovora" id="text_input" cols="400" rows="5"
              style="resize:none; size: 100%; position: center; padding: 0; color: #021B79; border-color: #021B79; font-size: 16px;"
              placeholder="Tekst odgovora..."></textarea>
            <br>

            <!-- JAVNO/PRIVATNO -->
            <div><input type="checkbox" id="anonimus" name="anonimus" value="1">
              <label for="anonimus" class="letters_dark_blue"> Želim anonimno da odgovorim na pitanje</label>
            </div>
            <br>

          </div>


          <!-- DUGMAD -->
          <div class="input ">
            <div id="like">
              <div style="float: right;">
                <button type="submit" class="w3-button buttons" style="font-weight: normal;" value="">Odustani</button> &nbsp
                <button type="submit" class="w3-button buttons" style="font-weight: normal;" value="">Pošalji</button> &nbsp
              </div>
            </div>
            <?php  if(!empty($poruka)) echo "<br> <span style='color:red; font-size:18px'>$poruka</span>"; ?>
          </div>
          <br>
        </div>
      </form>

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
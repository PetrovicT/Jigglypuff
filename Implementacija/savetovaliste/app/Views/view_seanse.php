
<!-- Katzenberger Viktor -->

<!DOCTYPE html>
<html>
    <head>
        <title>Pregled seansi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>/photos/logo.png" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/w3.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css" />
        <style>
            h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}
        </style>
        <script src="<?php echo base_url(); ?>/js/script.js"></script>
    </head>
    <body class="w3-light-grey">

        <!-- Header -->
        <?php
        require 'resources/header.php';
        ?>

        <br><br>

        <!-- w3-content defines a container for fixed size centered content, 
            and is wrapped around the whole page content, except for the footer in this example -->
        <div class="w3-content" style="max-width:90%">
            <!-- Filtriranje -->
            <div class="w3-row w3-padding w3-border">
                <div class="w3-col l12 s12">
                    <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
                        <div class="w3-left">
                            <form action="<?= site_url("$controller/pregled_seansi") ?>" method="get">
                                <input class="w3-input w3-left" type="date" style="width:300px; max-width:calc(100% - 46px)" name="datumSeanse"></input>
                                <button style="width:auto!important;" type="submit" class="w3-button buttons gradient_literature">Pretraga po datumu</button>
                            </form>
                        </div>
                        <div id="SeanceSearchBar" class="w3-right" style="width:346px; max-width: 100%;">
                            <form id="seansaPretraga" action="<?= site_url("$controller/pregled_seansi") ?>" method="get">
                                <a onclick='document.getElementById("seansaPretraga").submit();' href="" class="w3-button w3-right letters gradient_literature"><i class="fa fa-search"></i></a>
                                <input id="SeanceSearchField" name="pretraga" class="w3-input w3-right" type="text" placeholder="Pretraži seanse" style="width:300px; max-width:calc(100% - 46px);">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid -->
            <div class="w3-row w3-padding w3-border">
                <!-- Blog entries -->
                <div class="w3-col l8 s12">
                    <br />
                    <?php
                    if(count($sveSeanse) == 0){
                        echo '<h1>Nije pronađena nijedna seansa</h1>';
                    }
                    
                    $korisnikModel = new \App\Models\KorisnikModel();
                    foreach ($sveSeanse as $seansa) {
                        $oneSeansaData = [
                            'naziv' => $seansa->nazivSeanse,
                            'datum' => $seansa->datumPocetka,
                            'vreme' => $seansa->vremePocetka,
                            'idKorisnika' => $seansa->korisnik_idKorisnik_organizator,
                            'imeKorisnika' => $korisnikModel->findUserUsername($seansa->korisnik_idKorisnik_organizator),
                            'tekstSeanse' => $seansa->opisSeanse
                        ];
                        include 'resources/oneSeansaView.php';
                    }
                    ?>
                </div>
                <br />
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
            </div>
            <!-- END GRID -->
        </div>
        <!-- END w3-content -->
    </div>

    <!-- Footer -->
    <?php
    require 'resources/footer.php';
    ?>

</body>
</html>

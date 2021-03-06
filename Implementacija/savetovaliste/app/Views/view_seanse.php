
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>/js/seanse.js"></script>
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
                        <div class="w3-left w3-margin">
                            <form action="<?= site_url("$controller/pregled_seansi") ?>" method="get">
                                <input class="w3-input w3-left" type="date" style="width:300px; max-width:calc(100% - 46px)" name="datumSeanse">
                                <button style="width:auto!important;" type="submit" class="w3-button buttons gradient_literature">Pretraga po datumu</button>
                            </form>
                        </div>
                        <?php
                        // Ako je neko ulogovan, onda moze da vidi svoje seanse
                        if (session()->get('userid')) {
                            echo "
                            <div class = 'w3-left w3-margin'>
                            <form action = " . site_url("$controller/pregled_seansi") . " method = 'get'>
                            <input class = 'w3-input' type = 'hidden' style = 'width:300px; max-width:calc(100% - 46px)' name = 'samoMoje' value = 'true'>
                            <button style = 'width:auto!important;' type = 'submit' class = 'w3-button buttons gradient_literature'>Moje seanse</button>
                            </form>
                            </div>";
                        }
                        ?>
                        <div id="SeanceSearchBar" class="w3-right w3-margin" style="width:346px; max-width: 100%;">
                            <form id="pretraga_seansi" name="pretraga_seansi" action="<?= site_url("$controller/pregled_seansi") ?>">
                                <a onclick="document.getElementById('pretraga_seansi' ).submit();" class="w3-button gradient_literature w3-right letters"><i class="fa fa-search"></i></a>
                                <input id="SearchField" class="w3-input w3-right" type="text" placeholder="Pretra??i" name="pretraga" style="width:300px; max-width:calc(100% - 46px);">
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
                    if (count($sveSeanse) == 0) {
                        echo '<h1 class="letters_dark_blue w3-center">Nije prona??ena nijedna seansa</h1>';
                    } else {
                        $korisnikModel = new \App\Models\KorisnikModel();
                        $korisnikPrijavljenNaSeansuModel = new App\Models\KorisnikPrijavljenNaSeansuModel();
                        $seansaModel = new \App\Models\SeansaModel();
                        foreach ($sveSeanse as $seansa) {
                            $postojecaPrijavaKorisnika = $korisnikPrijavljenNaSeansuModel->findPrijava(session()->get('userid'), $seansa->idSeansa);
                            $oneSeansaData = [
                                'naziv' => $seansa->nazivSeanse,
                                'datum' => $seansa->datumPocetka,
                                'vreme' => $seansa->vremePocetka,
                                'idOrganizatora' => $seansa->korisnik_idKorisnik_organizator,
                                'imeOrganizatora' => $korisnikModel->findUserUsername($seansa->korisnik_idKorisnik_organizator),
                                'tekstSeanse' => $seansa->opisSeanse,
                                'maxPrijavljenih' => $seansa->maxBrojPrijavljenih,
                                'trenutnoPrijavljenih' => $korisnikPrijavljenNaSeansuModel->findNumberOfSignedUsers($seansa->idSeansa),
                                'idSeanse' => $seansa->idSeansa,
                                // Zabranjena prijava ako nije ve?? prijavljen a seansa je puna. Ako je prijavljen, nemoj zabraniti, mozda ho??e da se odjavi.
                                'zabranjenaPrijava' => $postojecaPrijavaKorisnika == null && $seansaModel->isSeansaFull($seansa->idSeansa),
                                'korisnikVecPrijavljen' => $postojecaPrijavaKorisnika != null,
                                'kontaktInfoUslovno' => $postojecaPrijavaKorisnika != null && $seansa->zoomLink != null ? "Zoom link: <a href = '" . $seansa->zoomLink . "'>" . $seansa->zoomLink . "</a>" : ""
                            ];
                            include 'resources/oneSeansaView.php';
                        }
                    }
                    ?>
                </div>
                <br />
                <!-- LITERATURA -->
                <div class="w3-col l4">
                    <div class="w3-white w3-margin w3-card-2">
                        <div class="w3-container w3-padding gradient_literature letters">
                            <h4>Preporu??ena literatura za sve ljubitelje psihologije</h4>
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
                                        <span style="font-weight: 500;"> Kolika je razlika izme??u mu??kog i ??enskog mozga? Postoji li zaista altruizam? Da li je na?? um,
                                            odmah po ro??enju, neispisana tablica?</span>

                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="<?php echo base_url(); ?>/photos/bez_granica-dzim_kvik_s.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Bez granica - D??im Kvik</b></span> <br>
                                        <span style="font-weight: 500;">Usavr??ite svoj mozak, u??ite br??e i otklju??ajte pristup izuzetnom ??ivotu za koji ste
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
                                        <span class="w3-medium"><b>Dete u tebi mora da prona??e svoj zavi??aj - ??tefani ??tal</b></span> <br>
                                        <span style="font-weight: 500;">Klju?? za re??avanje (skoro) svih problema. Svetski bestseler iz oblasti psihologije</span>
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
                                        <span style="font-weight: 500;">Svako mo??e, ako ??eli, da prona??e ne??to dragoceno u ovoj knjizi i da naposletku nau??i da se bolje
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
                                        <span style="font-weight: 500;"> Nau??nici ??irom sveta otkrili su dokaze za devet razli??itih uzroka depresije. Neki od njih su
                                            ukorenjeni u na??oj biologiji, ali ve??ina ih je u na??inu na koji danas ??ivimo.</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="<?php echo base_url(); ?>/photos/sta_nam_svako_telo_govori-dzo_navaro_s.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>??ta nam svako telo govori-D??o Navaro</b></span> <br>
                                        <span style="font-weight: 500;">Priru??nik biv??eg agenta FBI-a za brzo ?????itanje??? ljudi. Za??to je lice poslednje mesto na kojem
                                            treba tra??iti znake iskrenih emocija?</span>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="w3-row">
                                    <div class="w3-col s2 w3-white w3-center">
                                        <img src="<?php echo base_url(); ?>/photos/vise_se_ne_razumemo-izabel_fijioza_v.jpg" style="width:100%;">
                                    </div>
                                    <div class="w3-col s10 w3-left letters_dark_blue" style="padding-left: 10px;">
                                        <span class="w3-medium"><b>Vi??e se ne razumemo - Izabel Fijioza</b></span> <br>
                                        <span style="font-weight: 500;">U knjizi Vi??e se ne razumemo otkri??emo ??ta se de??ava u glavi i telu na??ih tinejd??era.</span>
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
                                        <span class="w3-medium"><b>Borba do pobede - Sr??an Krsti??</b></span> <br>
                                        <span style="font-weight: 500;">Ova knjiga je napisana s namerom da pomogne ljudima kojima je te??ko, onima koji ne vide
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

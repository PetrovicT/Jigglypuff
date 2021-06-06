<!-- Katzenberger Viktor -->

<!DOCTYPE html>
<html>
    <head>
        <title>Organizovane seanse</title>
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
            <h1 class="w3-center">Moje seanse</h1>

            <!-- Nova seansa -->
            <div class="w3-row w3-padding w3-border">
                <div class="w3-col l12 s12">
                    <div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
                        <div class="w3-left">
                            <h3 class="">Vi ste psiholog i možete da organizujete seansu <i class="fa fa-check" style="color:green"></i></h3>
                        </div>
                        <button class = "w3-right w3-button buttons" style="position:relative;width: auto;top: 9px;"
                                onclick="document.getElementById('NovaSeansaModal').style.display = 'block'">
                            Organizuj novu seansu
                        </button>
                    </div>
                </div>
            </div>

            <div id="NovaSeansaModal" class="w3-modal">
                <br><br>
                <div class="w3-modal-content w3-animate-top w3-card-4">
                    <header class="w3-container color-dark-blue"> 
                        <span onclick="document.getElementById('NovaSeansaModal').style.display = 'none'" class="w3-button w3-large w3-display-topright close-button">×</span>
                        <h2 class="w3-text-white">Nova seansa</h2>
                    </header>
                    <form class="w3-container" action='novaSeansaSubmit' method="post">

                        <br>
                        <div style="display: inline-block; min-width:60% ">
                            <label>Naziv seanse</label>
                            <input required id="novaSeansaNaziv" name="novaSeansaNaziv" class="w3-input" type="text">
                        </div>

                        <div style="display: inline-block; width:30%">
                            <label>Maksimalan broj prijavljenih</label>
                            <input required id="novaSeansaBrojLjudi" name="novaSeansaBrojLjudi" class="w3-input" type="number" min = "1">
                        </div>

                        <br><br>
                        <label>Opis</label>
                        <textarea required id="novaSeansaOpis" name="novaSeansaOpis" class="w3-input" style="max-width:100%;"></textarea>

                        <br>
                        <label>Vreme održavanja</label>
                        <div>
                            <input required id="novaSeansaDatum" name="novaSeansaDatum" class="w3-input" type="date" style="display:inline; width:40%" min="2021-04-10"></input>
                            <input required id="novaSeansaVreme" name="novaSeansaVreme" class="w3-input" type="time" style="display:inline; width:40%"></input>
                        </div>

                        <br>
                        <label>Zoom link</label>
                        <input required id="novaSeansaZoomLink" name="novaSeansaZoomLink" class="w3-input" type="url">

                        <br>
                        <input id="novaSeansaSubmit" name="novaSeansaSubmit" class="w3-input w3-button buttons" type="submit" value="Organizuj!">

                    </form> 
                    <br><br>
                </div>
            </div>

            <!-- Grid -->
            <div class="w3-row w3-padding w3-border">
                <br>
                <?php
                $korisnikModel = new \App\Models\KorisnikModel();
                $korisnikPrijavljenNaSeansuModel = new App\Models\KorisnikPrijavljenNaSeansuModel();
                foreach ($sveSeanse as $seansa) {
                    $oneSeansaData = [
                        'naziv' => $seansa->nazivSeanse,
                        'datum' => $seansa->datumPocetka,
                        'vreme' => $seansa->vremePocetka,
                        'tekstSeanse' => $seansa->opisSeanse,
                        'maxPrijavljenih' => $seansa->maxBrojPrijavljenih,
                        'trenutnoPrijavljenih' => $korisnikPrijavljenNaSeansuModel->findNumberOfSignedUsers($seansa->idSeansa),
                        'idSeanse' => $seansa->idSeansa
                        ];
                    include 'resources/oneMojaSeansaView.php';
                }
                ?>
            </div>
        </div>
        <!-- Footer -->
        <?php
        require 'resources/footer.php';
        ?>
    </body>
</html>

<!-- Petrovic Teodora -->
<!-- Urosevic Vera -->

<!DOCTYPE html>
<html>
    <head>
        <title>Izmena podataka</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>/photos/logo.png" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/pitanja.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/profil.css">
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}</style>
        <script src = "<?php echo base_url(); ?>/js/script.js"></script>
    </head>

    <body class="w3-light-grey">

        <!-- Header -->
        <?php

        use App\Models\PitanjeModel;
        use App\Models\OdgovorModel;
        use App\Models\KorisnikModel;
        use App\Models\GradModel;
        use App\Models\PolModel;
        use App\Models\TipKorisnikaModel;
        use App\Models\KategorijaPitanjaModel;

        require 'resources/header.php';
        $controller = session()->get("controller");
        $korisnikId = session()->get('userid');

        // dohvatanje korisnika ciji profil menjamo
        $korisnikModel = new KorisnikModel();
        $korisnik = $korisnikModel->find($korisnikId);
        
        // dohvatanje grada
        if ($korisnik->grad_idGrad == null)
            $nazivGrada = "Nije uneto";
        else {
            $gradModel = new GradModel();
            $nazivGrada = $gradModel->nadjiNazivGrada($korisnik->grad_idGrad);
        }
        // dohvatanje pola
        if ($korisnik->pol_idPol == null)
            $pol = "Nije uneto";
        else {
            $polModel = new PolModel();
            $pol = $polModel->nadjiPol($korisnik->pol_idPol);
        }
        // dohvatanje username
        $username = $korisnik->username;
        // dohvatanje licnog imena
        $licnoIme = $korisnik->licnoIme;
        if ($licnoIme == null)
            $licnoIme = "Nije uneto";
        // dohvatanje email
        $email = $korisnik->email;
        if ($email == null)
            $email = "Nije uneto";
        // dohvatanje kategorije korisnika
        $idKategorije = $korisnik->tipKorisnika_idTipKorisnika;
        $tipKorisnikaModel = new TipKorisnikaModel();
        $kategorija = $tipKorisnikaModel->find($idKategorije)->tip;

        // ispis stranice
        echo ' 
        <br> <br>   
        
        <div class="w3-row">   
            <div class="w3-row w3-left picture">
                <div class="w3-col s12"> 
                    <div class="w3-center w3-text-white ">';
        if ($korisnik->slika == null) {
            ?>
            <img src="<?php echo base_url(); ?>/photos/no_picture.png" alt="" style="width:25%;">  
            <?php
        } else
            echo '<img style="max-width:40%;" src="data:image/jpeg;base64,' . base64_encode($korisnik->slika) . '">';
        echo '
                    </div>    
                    <button class="w3-button buttons" style="display: block !important; margin:auto;" onclick="document.getElementById(\'novaSlika\').style.display = \'block\'">Izmeni sliku</button> 
                </div>
                
                <br><br>

                <div class="w3-row w3-center">
                    <div class="w3-col s12 color-dark-blue">
                        <div class="w3-center w3-text-white velika_slova"> ' . "$username" . '</div>
                    </div>
                </div>
                <br>
                           
                <div class="w3-row w3-center">
                <div class="w3-col s12"> 
                    <div class="slovaVelika"> Unesite samo one podatke koje želite da menjate: </div>
                </div>
                <br> 
                <hr style="border-top-color: #021B79;">
                </div> ';
        ?>
            <div class="w3-row w3-center" >
                <div class="w3-col s12">     
                    <div id="novaSlika" class="w3-modal">
                        <br><br>
                        <div class="w3-modal-content w3-animate-top w3-card-4">
                            <header class="w3-container color-dark-blue"> 
                                <span onclick="document.getElementById('novaSlika').style.display = 'none'" class="w3-button w3-large w3-display-topright close-button">×</span>
                                <h2 class="w3-text-white">Izmena slike</h2>
                            </header>
                            <form class="w3-container" action="<?= site_url("$controller/izmeniSliku") ?>" method = "post" enctype="multipart/form-data">

                                <br>
                                <div style="display: inline-block; ">
                                    <label>Uploadujte vašu novu sliku u JPG ili PNG formatu:</label>
                                    <input id="slikaFile" name="slikaFile" class="w3-input w3-button" type="file">
                                </div>

                                <br><br>
                                <input id="slikaSubmit" name="slikaSubmit" class="w3-input w3-button buttons" type="submit" value="Pošalji sliku!">

                            </form> 
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>

        <form name="izmeniProfil"  action="<?= site_url("$controller/izmeniProfil") ?>" method="post">                
            <div class="w3-row">
                <div class="w3-col s12"> 
                    <div class="slovaVelika">Lično ime: </div> 
                    <div> <input type="text" name="licnoIme" class="w3-input" placeholder="Unesite lično ime ili ostavite prazno" value="<?=$korisnik->licnoIme?>" ></div> <br>
                </div>  
            </div> 

            <div class="w3-row" >
                <div class="w3-col s12"> 
                    <div class="slovaVelika">Grad: </div>
                    <select class="select-input" name="grad" id="grad">
                        <?php
                        // Dodati sve gradove kao opcije u alfabetnom poretku
                        $gradModel = new \App\Models\GradModel();
                        $sviGradovi = $gradModel->findAllAlphabetical();
                        foreach ($sviGradovi as $grad) {
                            echo '<option value="' . $grad->idGrad . '" '. ($grad->idGrad==$korisnik->grad_idGrad ? 'selected="selected"' : '') .'>' . $grad->naziv . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="w3-row" >
                <div class="w3-col s12"> 
                    <div class="slovaVelika">Email: </div>
                    <div> <input type="text"  name="email" class="w3-input" placeholder="Unesite email ili ostavite prazno" value="<?=$korisnik->email?>"></div> <br>
                </div>
            </div>

            <div class="w3-row" >
                <div class="w3-col s12"> 
                    <div class="slovaVelika">Pol: </div>
                    <?php
                    $polModel = new \App\Models\PolModel();
                    $sviPolovi = $polModel->findAll();
                    $foundPol = false;
                    foreach ($sviPolovi as $pol) {
                        if($pol->idPol == $korisnik->pol_idPol){
                            $foundPol = true;
                        }                        
                        echo '<input type="radio" id="' . $pol->pol . '" name="gender" value="' . $pol->idPol . '" '. ($pol->idPol == $korisnik->pol_idPol ? 'checked' : '') .'>';
                        echo '<label for="' . $pol->pol . '">' . $pol->pol . '</label><br>';
                    }
                    ?>
                    <input type="radio" id="Drugo" name="gender" value="" <?= (!$foundPol? 'checked' : '') ?>>
                    <label for="Drugo">Drugo/Neizjašnjen</label>
                </div> 
            </div><br>

            <div class="w3-row" >
                <div class="w3-col s12"> 
                    <div class="slovaVelika">Nova lozinka: </div>
                    <div> <input type="password" name="novaLozinka" class="w3-input" placeholder="Unesite novu lozinku ili ostavite prazno"></div> <br>
                </div>
            </div>

            <div class="w3-row w3-center">
                <div class="w3-col s12"> 
                    <div class="slovaVelika"> Obavezno unesite svoju aktuelnu lozinku kako bi izmena profila bila moguća:</div>
                </div>
                <br> 
                <hr style="border-top-color: #021B79;">
            </div>

            <div class="w3-row" >
                <div class="w3-col s12"> 
                    <input class="w3-input" type="password" name="aktuelnaLozinka" placeholder="Aktuelna lozinka" style="display:inline-block">
                </div>
            </div>
            <br>

            <div class="w3-row w3-right" >
                <div class="w3-col s12"> 
                    <button type="submit" class="w3-button buttons"><u style="text-decoration: none; font-weight: normal;">Sačuvaj izmene</u></button>
                </div>
            </div>
            <?php if (!empty($porukaLozinka)) echo "<span style='color:red; font-size:18px'>$porukaLozinka</span>"; ?> 
            <?php if (!empty($porukaPogresnaLozinka)) echo "<span style='color:red; font-size:18px'>$porukaPogresnaLozinka</span>"; ?> 
            <br> <br> <br> 
        </form>  
        <?php
// unapredjenje u psihologa ako nismo vec psiholog nego samo registrovan korisnik
        if ($kategorija == "Korisnik") {
            ?>

            <div class="w3-row w3-center" >
                <div class="w3-col s12"> 
                    <button class = "w3-button buttons" style="width:100%" onclick="document.getElementById('unapredjenje').style.display = 'block'">Želim da predam dokumentaciju za unapređenje u korisnika psihologa</button>
                </div>
            </div> 

        <?php } ?>

        <br>
        <div class="w3-row w3-center" >
            <div class="w3-col s12"> 

                <div id="unapredjenje" class="w3-modal">
                    <br><br>
                    <div class="w3-modal-content w3-animate-top w3-card-4">
                        <header class="w3-container color-dark-blue"> 
                            <span onclick="document.getElementById('unapredjenje').style.display = 'none'" class="w3-button w3-large w3-display-topright close-button">×</span>
                            <h2 class="w3-text-white">Pošalji zahtev za unapređenje naloga u psihologa</h2>
                        </header>
                        <form class="w3-container" action="<?= site_url("$controller/zahtevajPromociju") ?>" method = "post" enctype="multipart/form-data">

                            <br>
                            <div style="display: inline-block; ">
                                <label>Vaša zvanična dokumentacija:</label>
                                <input id="promocijaFile" name="promocijaFile" class="w3-input w3-button" type="file">
                            </div>

                            <br><br>
                            <input id="promocijaSubmit" name="promocijaSubmit" class="w3-input w3-button buttons" type="submit" value="Pošalji zahtev!">

                        </form> 
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
</div>
<br><br><br>

<?php
// dodavanje footera
require 'resources/footer.php';
?>  

</body>
</html>

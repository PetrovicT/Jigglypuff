<!-- Petrovic Teodora -->
<!-- Urosevic Vera -->

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
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/profil.css">
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src = "<?php echo base_url(); ?>/js/profil.js"></script>
        <script src = "<?php echo base_url(); ?>/js/script.js"></script>
        <title>Pregled profila</title>
    </head>

    <body class="w3-light-grey">

        <!-- Header -->
        <?php
        require 'resources/header.php';
        ?>

        <?php
        // dohvatanje kontrolera i userId
        $controller = session()->get("controller");
        $userId = $idKorisnikaCijiProfilGledamo;

        // korisnik model nam treba radi dohvatanja podataka o korisniku ciji profil gledamo
        use App\Models\KorisnikModel;
        use App\Models\PolModel;
        use App\Models\GradModel;
        use App\Models\TipKorisnikaModel;
        use App\Models\KorisnikOcenioPsihologaModel;
        ?>
        <div>
            <!-- Profil-->
            <?php
            $korisnikModel = new KorisnikModel();
            $korisnik = $korisnikModel->find("$userId");
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

            echo '

 
        <br> <br>  

        
        
            
        <div class="w3-row w3-center picture">
   

                    <div class="w3-col s12"> 
                        <div class="w3-center w3-text-white slika">';
            if ($korisnik->slika == null) {
                ?>
                <img src="<?php echo base_url(); ?>/photos/no_picture.png" alt="" style="width:20%;">  
                <?php
            } else
                echo '<img src="data:image/jpeg;base64,' . base64_encode($korisnik->slika) . '">';

            echo '</div>
                    </div>
                    <br>
                

                <div class="w3-row w3-center">
                    <div class="w3-col s12 color-dark-blue"> 
                    <br>
                        <div class="w3-center w3-text-white velika_slova"> ' . "$username" . '</div>
                    <br>
                    </div>
                </div>
                <br>
                           

                <div class="w3-row w3-center">
                    <div class="w3-col s12"> 
                        <div class="slovaVelika">Lično ime: </div>
                        <div class="slovaMala">' . "$licnoIme" . '</div>  
                    </div>  
                </div>  
                <div class="w3-row" >
                    <div class="w3-col s12"> 
                        <div class="slovaVelika">Grad: </div>
                        <div class="slovaMala">' . "$nazivGrada" . '</div>
                    </div>
                </div>
                <div class="w3-row"">
                    <div class="slovaVelika">Email adresa: </div>
                    <div class="slovaMala">' . "$email" . '</div>
                </div>
                <div class="w3-row">
                    <div class="slovaVelika ">Pol: </div>
                    <div class="slovaMala ">' . "$pol" . '</div>
                </div>
                <div class="w3-row">
                    <div class="slovaVelika ">Kategorija korisnika: </div>
                    <div class="slovaMala ">' . "$kategorija" . '</div>
                </div>
                <br>

            </div>
            ';
            if ($kategorija == "Psiholog") {
                $korisnikOcenioPsihologaModel = new KorisnikOcenioPsihologaModel();
                $likes = $korisnikOcenioPsihologaModel->findNumOfLikes($korisnik->idKorisnik);
                $dislikes = $korisnikOcenioPsihologaModel->findNumOfDislikes(($korisnik->idKorisnik));
                $disabledProperty = session()->get('controller') == 'Gost' ? "disabled" : "";

                echo '
                    <br> 

                    <div class="w3-row w3-center picture">
                        <div class="slovaVelika ">Pregled dosadašnjih ocena psihologa ' . "$username" . ': </div> <br>

                            <div class="w3-center">
                                
                                <button ' . $disabledProperty . ' class="w3-button dugmeOceniPsihologa w3-center" onclick="like_or_dislike_psiholog(this,' . $korisnik->idKorisnik . ',1)"><i class="fa fa-thumbs-up"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Pozitivna ocena (' . "$likes" . ')</u></button> &nbsp
                                
                                <button ' . $disabledProperty . ' class="w3-button dugmeOceniPsihologa w3-center" onclick="like_or_dislike_psiholog(this,' . $korisnik->idKorisnik . ',0)"><i class="fa fa-thumbs-down"></i> <u onclick="" style="text-decoration: none; font-weight: normal;">Negativna ocena (' . "$dislikes" . ')</u></button>
                            </div>
                            <br> <br>
                    </div>
                    <br> 
                ';
            }
            echo '
            <br>
        <br>
        <br>
        '; // kraj echo
            ?> 


<?php
require 'resources/footer.php';
?>

            </body>
            </html>

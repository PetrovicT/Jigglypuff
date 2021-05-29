
<!-- Urosevic Vera -->

<!DOCTYPE html>
<html>
    <head>
        <title>Registruj se</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>/photos/logo.png" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/logovanje.css">
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}</style>
        <script src = "<?php echo base_url(); ?>/js/script.js"></script>
    </head>

    <body class="w3-light-grey">

        <!-- Header -->
        <?php
        require 'resources/header.php';
        ?>

        <!-- Registracija -->
        <div class="logovanje">
            <div class="wrapper">
                <div class="Naslov"><b>Formular za registrovanje</b></div>

                <div>Sledeca polja su obavezna, molimo Vas da ih popunite. Obratite paznju da Vasa sifra mora sadrzati minimum 8 karaktera.</div>

                <div class="form-container">
                    <div class="form-inner">
                        <form action="#" class="login" method="post">
                            <div class="field">
                                <input name="username" type="text" placeholder="Korisnicko ime" required>
                            </div> 
                            <div class="field">
                                <input name="password" type="password" placeholder="Sifra" required>
                            </div> 
                            <div class="field">
                                <div>Sledeca polja nisu obavezna, tako da ih mozete ostaviti praznim. </div>
                                <input name="licnoIme" type="text" placeholder="Licno ime" >
                            </div> 
                            <div class="field">
                                <input name = "grad" type="text" placeholder="Grad" list="gradovi" >
                                <datalist id="gradovi">
                                    <?php
                                    // Dodati sve gradove kao opcije u alfabetnom poretku
                                    $gradModel = new \App\Models\GradModel();
                                    $sviGradovi = $gradModel->findAllAlphabetical();
                                    foreach ($sviGradovi as $grad) {
                                        echo '<option value="'.$grad->idGrad.'">'.$grad->naziv.'</option>';
                                    }
                                    ?>
                                </datalist>
                            </div> 
                            <div class="field">
                                <input name = "email" type="email" placeholder="Email adresa" >
                            </div> 

                            <div>Pol:</div>
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Muski</label><br>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Zenski</label><br>
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="other">Drugo</label>

                            <div class="field">
                                <input type="submit" value="Registrujte se">
                            </div>
                            <div class="singup-link">
                                Vec imate korisnicki nalog? <a href="<?php echo base_url(); ?>/Gost/login"><b>Ulogujte se</b></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- Registracija -->


        <!-- Footer -->
        <?php
        require 'resources/footer.php';
        ?>

    </body>
</html>

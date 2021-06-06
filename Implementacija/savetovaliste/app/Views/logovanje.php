<!-- Katzenberger Viktor -->
<!-- Urosevic Vera -->

<!DOCTYPE html>
<html>
    <head>
        <title>Uloguj se</title>
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

        <!-- Logovanje-->
        <div class="logovanje">
            <div class="wrapper">
                <div class="Naslov"><b>Formular za logovanje</b></div>

                <div class="form-container">
                    <div class="form-inner">
                        <form action="<?= site_url("Gost/loginSubmit") ?>" class="login" method="post">
                            <div class="field">
                                <input name="username" type="text" placeholder="Korisnicko ime" >
                            </div> 
                            <div class="field">
                                <input name="password" type="password" placeholder="Sifra" >
                            </div> 

                            <font color='red'>
                            <?php
                            if (!empty($loginErrorMessage)) {
                                echo $loginErrorMessage;
                            }
                            ?></font>

                            <div class="field">
                                <input type="submit" value="Ulogujte se">
                            </div>
                            <div class="singup-link">
                                Nemate korisnicki nalog? <a href="<?php echo site_url('Gost/register'); ?>"><b>Registrujte se</b></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <?php
        require 'resources/footer.php';
        ?>

    </body>
</html>

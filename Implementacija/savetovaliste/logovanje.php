
<!-- Urosevic Vera -->

<!DOCTYPE html>
<html>
    <head>
        <title>Uloguj se</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="photos/logo.png" />
        <link rel="stylesheet" href="css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/logovanje.css">
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}</style>
        <script src = "js/script.js"></script>
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
                        <form action="#" class="login">
                            <div class="field">
                                <input type="text" placeholder="Korisnicko ime" required>
                            </div> 
                            <div class="field">
                                <input type="password" placeholder="Sifra" required>
                            </div> 
                            <div class="field">
                                <input type="submit" value="Ulogujte se">
                            </div>
                            <div class="singup-link">
                                Nemate korisnicki nalog? <a href="registracija.html"><b>Registrujte se</b></a>
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

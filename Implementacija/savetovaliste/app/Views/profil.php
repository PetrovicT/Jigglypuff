
<!-- Urosevic Vera -->

<!DOCTYPE html>
<html>
    <head>
        <title>Snorlax123</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="photos/logo.png" />
        <link rel="stylesheet" href="css/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/profil.css">
        <style>h1,h2,h3,h4,h5,h6 {font-family: "Oswald"} body {font-family: "Open Sans"}</style>
        <script src = "js/script.js"></script>
    </head>

    <body class="w3-light-grey">

        <!-- Header -->
        <?php
        require 'resources/header.php';
        ?>

        <!-- Profil-->

        <div class="picture">
            <div class="picture-container">
                <img src="profil.jpg" style="width: 100%;">
            </div>
            <div class="name color-dark-blue name"><h2>@Snorlax123</h2></div>
            <div ><h3>Licno ime</h3>Anja Jovanovic</div>
            <div><h3>Grad</h3>Beograd</div>
            <div><h3>Email adresa</h3>anja@gmail.com</div>
            <div><h3>Pol</h3>zenski</div>
            <a href="profilIzmena.html" class="w3-button color-dark-blue name w3-padding-midium w3-margin-bottom">Izmeni podatke na mom profilu</a>
        </div>

        <!-- Footer -->
        <?php
        require 'resources/footer.php';
        ?>

    </body>
</html>

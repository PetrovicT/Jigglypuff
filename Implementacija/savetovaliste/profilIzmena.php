
<!-- Urosevic Vera -->

<!DOCTYPE html>
<html>
    <head>
        <title>Izmeni podatke</title>
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
                <a href="#" class="w3-button buttons color-dark-blue name w3-padding-small">Promeni sliku</a>
            </div>
            <div class="name color-dark-blue" ><h2>@Snorlax123</h2></div>
            <div><h3>Licno ime</h3>
                <input type="text" class="w3-input" placeholder="Anja Jovanovic" >
            </div>
            <div><h3>Grad</h3><input type="text" class="w3-input" placeholder="Beograd" ></div>
            <div><h3>Email adresa</h3><input type="email" class="w3-input" placeholder="anja@gmail.com" ></div>
            <div><h3>Pol:</h3></div>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Muski</label><br>
            <input type="radio" id="female" name="gender" value="female" checked>
            <label for="female">Zenski</label><br>
            <input type="radio" id="other" name="gender" value="other">
            <label for="other">Drugo</label>
            <div><h3>Nova sifra</h3><input class="w3-input" type="password" placeholder="" ></div>
            <div></div>Kako bismo bili sigurni da niko drugi ne menja informacije o Vama, zamolili bismo Vas da ponovo unesete svoju sifru:
            <input class="w3-input" type="password" placeholder="Sifra" required style="width:200px; max-width:100%; display:inline-block">
            <a href="profil.html" class="w3-button color-dark-blue name w3-padding-midium w3-margin-bottom ">Zavrsi sa izmenama</a>

            <hr>

            <button class = "w3-button buttons" style="width:auto" onclick="document.getElementById('PromocijaModal').style.display = 'block'">Unapređenje u psihologa</button>

            <div id="PromocijaModal" class="w3-modal">
                <br><br>
                <div class="w3-modal-content w3-animate-top w3-card-4">
                    <header class="w3-container color-dark-blue"> 
                        <span onclick="document.getElementById('PromocijaModal').style.display = 'none'" class="w3-button w3-large w3-display-topright close-button">×</span>
                        <h2 class="w3-text-white">Pošalji zahtev za unapređenje naloga u psihologa</h2>
                    </header>
                    <form class="w3-container">

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

        <!-- Footer -->
        <?php
        require 'resources/footer.php';
        ?>

    </body>
</html>

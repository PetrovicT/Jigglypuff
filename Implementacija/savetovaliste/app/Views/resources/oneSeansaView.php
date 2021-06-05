<!-- Izgled jedne seanse -->
<!-- Obavezno deklarisati PHP varijablu sa svim podacima pre includovanja ovoga -->
<!-- PHP variable name: $oneSeansaData -->
<!-- Polja: naziv, datum, vreme, idKorisnika, imeKorisnika, tekstSeanse -->


<div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
    <div class="w3-left" style="padding-left: 5%;">
        <br />
        <h3 class="letters_dark_blue">
            <b><?= $oneSeansaData['naziv'] ?></b>
        </h3>
        <h5><span class="w3-opacity"><?=$oneSeansaData['datum']?>, <?=$oneSeansaData['vreme']?></span></h5>
    </div>
    <div class="w3-right" style="padding-right: 6%;">
        <br />
        <h3 class="letters_dark_blue">
            <a href="<?= site_url("$controller/profil/".$oneSeansaData['idKorisnika'] )?>"><b><?=$oneSeansaData['imeKorisnika']?></b></a>
        </h3>
    </div>
    <!-- Input section -->
    <div class="input letters_dark_blue">
        <p style="text-align: justify;"><?=$oneSeansaData['tekstSeanse']?> </p>
        <br />
    </div>
    <!-- Anwser input -->
    <div class="input">
        <!-- Buttons -->
        <div id="like">
            <div style="float: right;">
                <button class="w3-button buttons">
                    <b>Prijavi se (3/4)</b>
                </button></div>
        </div>
    </div>
    <br />
</div>
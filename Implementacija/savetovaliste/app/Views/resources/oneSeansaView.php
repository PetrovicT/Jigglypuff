<!-- Izgled jedne seanse -->
<!-- Obavezno deklarisati PHP varijablu sa svim podacima pre includovanja ovoga -->
<!-- PHP variable name: $oneSeansaData -->
<!-- Polja: naziv, datum, vreme, idOrganizatora, imeOrganizatora, tekstSeanse, maxPrijavljenih, trenutnoPrijavljenih, idSeanse, zabranjenaPrijava, kontaktInfoUslovno -->


<div class="w3-container w3-light-grey w3-margin w3-padding-large w3-card-4">
    <div class="w3-left" style="padding-left: 5%;">
        <br />
        <h3 class="letters_dark_blue">
            <b><?= $oneSeansaData['naziv'] ?></b>
        </h3>
        <h5><span class="w3-opacity"><?= $oneSeansaData['datum'] ?>, <?= $oneSeansaData['vreme'] ?></span></h5>
    </div>
    <div class="w3-right" style="padding-right: 6%;">
        <br />
        <h3 class="letters_dark_blue">
            <a href="<?= site_url("$controller/profil/" . $oneSeansaData['idOrganizatora']) ?>"><b><?= $oneSeansaData['imeOrganizatora'] ?></b></a>
        </h3>
    </div>
    <!-- Input section -->
    <div class="input letters_dark_blue">
        <p style="text-align: justify;"><?= $oneSeansaData['tekstSeanse'] ?> </p>
        <br />
    </div>
    
    <div class="input letters_dark_blue">
        <i><?= $oneSeansaData['kontaktInfoUslovno'] ?> </i>
        <br />
    </div>
    <!-- Anwser input -->
    <?php
    if (session()->get('controller') != 'Gost') {
        $trenutnoPrijavljenih = $oneSeansaData['trenutnoPrijavljenih'];
        $maxPrijavljenih = $oneSeansaData['maxPrijavljenih'];
        $idSeanse = $oneSeansaData['idSeanse'];
        $disabledOrNot = $oneSeansaData['zabranjenaPrijava'] ? 'disabled' : '';
        $natpisDugmeta = $oneSeansaData['korisnikVecPrijavljen'] ? "Odjavi se" : "Prijavi se";
        echo "
        <div class='input'>
            <div id='like'>
                <div style='float: right;'>
                    <button onclick='prijaviSeansu(this,$idSeanse)' class='w3-button buttons' $disabledOrNot>
                        <b>$natpisDugmeta ($trenutnoPrijavljenih/$maxPrijavljenih)</b>
                    </button>
                </div>
            </div>
        </div>";
    } else {
        echo "
        <div style='float: right; color: gray;'>
            Ulogujte se ili napravite nalog kako biste se prijavili na seansu!
        </div>";
    }
    ?>

    <br />
</div>
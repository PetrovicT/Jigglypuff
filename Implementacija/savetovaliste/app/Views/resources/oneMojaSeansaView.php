<?php
// Priprema podataka
$oneSeansaData = [
    'naziv' => $seansa->nazivSeanse,
    'datum' => $seansa->datumPocetka,
    'vreme' => $seansa->vremePocetka,
    'tekstSeanse' => $seansa->opisSeanse,
    'maxPrijavljenih' => $seansa->maxBrojPrijavljenih,
    'trenutnoPrijavljenih' => $korisnikPrijavljenNaSeansuModel->findNumberOfSignedUsers($seansa->idSeansa),
    'idSeanse' => $seansa->idSeansa
];
$naziv = $oneSeansaData['naziv'];
$datum = $oneSeansaData['datum'];
$vreme = $oneSeansaData['vreme'];
$opis = $oneSeansaData['tekstSeanse'];
$maxPrijavljenih = $oneSeansaData['maxPrijavljenih'];
$trenutnoPrijavljenih = $oneSeansaData['trenutnoPrijavljenih'];
$idSeanse = $oneSeansaData['idSeanse'];
?>

<div class="w3-container w3-col l3ipo m5ipo w3-light-grey w3-margin-small-adaptive w3-card-4">
    <div class="w3-left" style="padding-left: 5%;">
        <br />
        <h3 class="letters_dark_blue">
            <b><?= $naziv ?></b>
        </h3>
        <h5><span class="w3-opacity"><?= $datum ?>, <?= $vreme ?></span></h5>
    </div>
    <!-- Input section -->
    <div class="input letters_dark_blue">
        <p style="text-align: justify;"><?= $opis ?></p>
        <br />
    </div>

    <?php
    // logika za dobijanje imena korisnika
    $sviPrijavljeniKorisnici = $korisnikPrijavljenNaSeansuModel->findAllKorisniciForSeansa($idSeanse);
    ?>

    <div class="input">
        <!-- Buttons -->
        <div>
            <div class="w3-left w3-padding">
                <b class="">Prijavljeno: <?= $trenutnoPrijavljenih ?>/<?= $maxPrijavljenih ?></b>
                <br>
                <?php
                foreach ($sviPrijavljeniKorisnici as $prijavljenKorisnik) {
                    echo '<a href="' . site_url('Korisnik/profil/' . $prijavljenKorisnik->idKorisnik) . '">' . $prijavljenKorisnik->username . '</a><br>';
                }
                ?>
            </div>
            <div class="w3-right">
                <form action="<?= site_url("$controller/izbrisi_seansu/$idSeanse") ?>" method="post">
                    <button class="w3-button buttons" type="submit">
                        <b>Ukloni</b>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <br />
</div>
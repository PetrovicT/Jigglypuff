<!-- Header -->

<header class="w3-bar w3-padding-12 color-dark-blue w3-mobile">
    <!-- S leva nadesno -->
    <a href="<?= site_url() ?>" class="w3-bar-item w3-button letters"><i class="fa fa-home"></i> Home</a>


    <div class="w3-dropdown-hover w3">
        <a href="pregled_pitanja.html" class="w3-bar-item w3-button letters"><i class="fa fa-question-circle-o"></i>
            Kategorije</a>
        <div id="CategoryDropdownMenu" class="w3-dropdown-content w3-bar-block w3-card-4">
            <?php
            foreach ($sveKategorijePitanja as $kategorija) {
                echo '<a href="';
                echo site_url("$controller/pregled_pitanja_po_kategoriji?pretraga=$kategorija->kategorija");
                echo '" class="w3-bar-item w3-button "><i class="fa fa-angle-double-right"></i>';
                echo $kategorija->kategorija;
                echo '</a>';
            }
            ?>
        </div>
    </div>

    <a href="<?= site_url("$controller/view_seanse") ?>" class="w3-bar-item w3-button" style="color: white;"><i class="fa fa-fire"></i> Seanse</a>

    <div class="w3-dropdown-hover w3-right">
        <a href="#" class="w3-bar-item w3-button letters"><i class="fa fa-user"></i> Gost</a>
        <div id="UserDropdownMenu" class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="<?= site_url("login") ?>" class="w3-bar-item w3-button"><i class="fa fa-user-plus"></i> Registruj se</a>
            <a href="<?= site_url("register") ?>" class="w3-bar-item w3-button"><i class="fa fa-sign-in"></i> Uloguj se</a>
        </div>
    </div>

    <div id="SearchBar" class="w3-right" style="width:346px; max-width: 100%;">
        <form id="pretraga_header" name="pretraga_pitanja"  action="<?= site_url("$controller/pretraga_pitanja") ?>">
            <a onclick='document.getElementById("pretraga_header").submit();' class="w3-bar-item w3-button w3-right letters"><i class="fa fa-search"></i></a>
            <input id="SearchField" class="w3-bar-item w3-right" type="text" placeholder="Pretraži" name="pretraga" style="width:300px; max-width:calc(100% - 46px);">
        </form>
    </div>
</header>


<!DOCTYPE html>
<html>
<head>
    <title>Webhosting</title>
    <link rel="stylesheet" href="css/mainPage.css">
</head>
<body>


<nav>


    <div class="header">
        <a class="noDecor" href="index.php">
            <img class="logoMain" src="img/logo.svg">
            W e b h o s t i n g


        </a>
    </div>


    </div>
    <div class="sluzby-dropdown">
        <button class="sluzby-dropbtn">Služby</button>
        <div class="sluzby-dropdown-content">
            <a href="#">Webhosting</a>
            <a href="#">VM hosting</a>
        </div>
    </div>


    <?php
    session_start();
    //    if (!isset($_COOKIE['is_logged']) || $_COOKIE['is_logged'] == false) : ?>
    <div class="prihlaseni-dropdown">
        <button class="prihlaseni-dropbtn">Přihlášení</button>
        <div class="prihlaseni-dropdown-content">
            <a href="loginUzivZona.php">Uživatelská zóna</a>
            <a href="registrationUzivZona.php">Registrace</a>
            <a href="loginControlPanel.php">Správa služeb</a>
        </div>

    </div>
    <!--    --><?php //else : ?>
    <!--        <div class="prihlaseni-dropdown">
                <button class="prihlaseni-dropbtn">Uživatel</button>
                <div class="prihlaseni-dropdown-content">
                    <a href="uzivZona.php">Uživatelská zóna</a>
                    <a href="loginControlPanel.php">Správa služeb</a>
                </div>
            </div>-->
    <!--    --><?php //endif; ?>


</nav>
<main class="mainPageContent">
    <h1 class="center">Hostingové služby zdarma</h1>
    <h3>Stačí se registrovat. Po přihlášení získáte možnost objednání služeb.</h3>
    <div class="flexBoxFeatures">
        <div class="boxFeatures">
            <h4>Doména zdarma</h4>
            <p class="featureDescription">
                Zdarma si můžete vybrat poddoménu přímo v objednávce.
            </p>
        </div>
        <div class="boxFeatures">
            <h4>SQL přístup</h4>
            <p class="featureDescription">
                Kompletní přístup do MariaDB databáze přes terminál v ovládacím panelu, nebo přímo v PhpMyAdmin.
            </p>
        </div>
        <div class="boxFeatures">
            <h4>FTP přístup</h4>
            <p class="featureDescription">
                Dostanete přístup do vašeho adresáře přes webový prohlížeč, nebo pomocí Vámi vybraného FTP klienta.
            </p>
        </div>
    </div>
    <div class="flexCenter">
    <button onclick="loadRegistration()" class="buttonRegistration">
        Registrace zdarma
        <div class="arrow-wrapper">
            <div class="arrow"></div>

        </div>
    </button>
    </div>

</main>


</body>
</html>

<script>
    function loadRegistration() {
        location.href = "registrationUzivZona.php";
    }
</script>
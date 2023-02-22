<!DOCTYPE html>
<html>
<head>
    <title>Webhosting</title>
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/loginUzivZona.css">
    <link rel="stylesheet" href="css/uzivZona.css">
</head>
<body>


<nav>
    <div class="header">
        <a class="noDecor" href="index.php">
            <img class="logoMain" src="img/logo.svg">
            W e b h o s t i n g
        </a>
    </div>

    <div class="divStretch"> Přihlášený uživatel:
        <?php
        if (isset($_COOKIE['logged_user_conpanel'])) {
            echo $_COOKIE['logged_user_conpanel'];
        }
        ?>
    </div>
    <div class="uzivZonaHeader">
        <button class="uzivZonaHeaderNadpis">Ovládací panel</button>

    </div>

</nav>
<main class="uzivZonaMain">
    <aside>
        <button>Správa</button>
        <button onclick="document.location='controlPanelPages/mysql/mysql.php'">MySQL</button>
        <button>FTP přístup</button>
        <button onclick="document.location='logout/controlLogout.php'">Odhlásit</button>
    </aside>
    <section>
        content contetnt ncontent conetntn
    </section>

</main>


</body>
</html>
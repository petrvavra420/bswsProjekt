<?php
session_start();
?>
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
        if (isset($_COOKIE['logged_user']))
            echo $_COOKIE['logged_user'];
        ?>
    </div>
    <div class="uzivZonaHeader">
        <button class="uzivZonaHeaderNadpis">Uživatelská zóna</button>

    </div>

</nav>
<main class="uzivZonaMain">
    <aside>
        <button>Objednat službu</button>
        <button>Přehled vašich služeb</button>
        <button>Platby</button>
        <button>Účet</button>
        <button>Odhlásit</button>
    </aside>
    <section>
        content contetnt ncontent conetntn
    </section>

</main>


</body>
</html>
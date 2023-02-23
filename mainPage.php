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
            W e b h o s t i n g</a>
    </div>


    </div>
    <div class="sluzby-dropdown">
        <button class="sluzby-dropbtn">Služby</button>
        <div class="sluzby-dropdown-content">
            <a href="#">Webhosting</a>
            <a href="#">VM hosting</a>
            <a href="#">Link 3</a>
        </div>
    </div>


    <?php
    session_start();
    if (!isset($_COOKIE['is_logged']) || $_COOKIE['is_logged'] == false) : ?>
        <div class="prihlaseni-dropdown">
            <button class="prihlaseni-dropbtn">Přihlášení</button>
            <div class="prihlaseni-dropdown-content">
                <a href="loginUzivZona.php">Uživatelská zóna</a>
                <a href="registrationUzivZona.php">Registrace</a>
                <a href="loginControlPanel.php">Správa služeb</a>
            </div>

        </div>
    <?php else : ?>
        <div class="prihlaseni-dropdown">
            <button class="prihlaseni-dropbtn">Uživatel</button>
            <div class="prihlaseni-dropdown-content">
                <a href="uzivZona.php">Uživatelská zóna</a>
                <a href="loginControlPanel.php">Správa služeb</a>
            </div>
        </div>
    <?php endif; ?>


</nav>
<main>
    <?php
        include("dbcon.php");
        echo "password: ". password_hash("sluzba",PASSWORD_DEFAULT);
    ?>
</main>


</body>
</html>
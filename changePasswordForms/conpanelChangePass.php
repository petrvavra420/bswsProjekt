<?php
    if (isset($_POST['inputPassChangeConpanel'])){
        echo "OK";
        if (isset($_POST['currPass'])){
            $currPass = $_POST['currPass'];
        }
        if (isset($_POST['newPass'])){
            $newPass = $_POST['newPass'];
        }
        if (isset($_POST['newPassConfirm'])){
            $newPassConfirm = $_POST['newPassConfirm'];
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Webhosting</title>
    <link rel="stylesheet" href="../css/mainPage.css">
    <link rel="stylesheet" href="../css/loginUzivZona.css">
    <link rel="stylesheet" href="../css/uzivZona.css">
    <link rel="stylesheet" href="../css/passChangeForms.css">


</head>


<nav>
    <div class="header">
        <a class="noDecor" href="index.php">
            <img class="logoMain" src="../img/logo.svg">
            W e b h o s t i n g
        </a>
    </div>

    <div class="divStretch">
        <!-- Přihlášený uživatel:
         --><?php
        /*        if (isset($_COOKIE['logged_user_conpanel'])) {
                    echo $_COOKIE['logged_user_conpanel'];
                }
                */ ?>
    </div>
    <div class="uzivZonaHeader">
        <button class="uzivZonaHeaderNadpis"></button>

    </div>

</nav>

<main class="flexCenter">

    <div class="passChangeConpanelContent">
        <form method="post" class="passChangeConpanelForm">
            <h4>Aktuální heslo</h4>
            <span class="flexCenter">
                <input required class="inputTextPass" name="currPass" type="password">
            </span>
            <h4>Nové heslo</h4>
            <span class="flexCenter">
                <input required class="inputTextPass" name="newPass" type="password">
            </span>
            <h4>Nové heslo znovu</h4>
            <span class="flexCenter">
                <input required class="inputTextPass" name="newPassConfirm" type="password">
            </span>
            <br>
            <span class="flexCenter">
            <input class="inputSubmitPass" value="Potvrdit" name="inputPassChangeConpanel" type="submit">
            </span>
        </form>
    </div>
</main>


</body>

</html>

<script>


</script>

<?php
if (isset($_POST['inputPassChangeConpanel'])) {
    $userConpanel = $_COOKIE['logged_user_conpanel'];

    if (isset($_POST['currPass'])) {
        $currPass = $_POST['currPass'];
    }
    if (isset($_POST['newPass'])) {
        $newPass = $_POST['newPass'];
    }
    if (isset($_POST['newPassConfirm'])) {
        $newPassConfirm = $_POST['newPassConfirm'];
    }
    if (isset($currPass) && isset($newPass) && isset($newPassConfirm)) {
        include_once("../dbcon.php");
        $updateOk = true;
        $errorMsg = "none";

        $sqlUse = "use projekt";
        $sendUse = mysqli_query($conn, $sqlUse);
        $sql = "SELECT id, password FROM control_panel_users WHERE (login ='" . $userConpanel . "')";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $userFoundCount = mysqli_num_rows($result);

        if ($userFoundCount == 1) {
            if (password_verify($currPass, $row['password'])) {

                if ($newPass == $newPassConfirm) {
                    if ($newPass == $currPass) {
                        $updateOk = false;
                        $errorMsg = "sameAsOld";
                    }
                } else {
                    $updateOk = false;
                    $errorMsg = "passNotSame";
                }

            } else {
                $updateOk = false;
                $errorMsg = "wrongActualPass";
            }
        } else {
            $updateOk = false;
        }

        if ($updateOk) {
            //shell_exec("") // nové heslo máš v $newPass, conpanel user je v $userConpanel
        }


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
        <a class="noDecor" href="../index.php">
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
            <span class="flexCenter" id="passErrorMsg">
                <?php
                if (isset($errorMsg)) {
                    if ($errorMsg != "none") {
                        switch ($errorMsg) {
                            case "sameAsOld":
                                echo "Zadané heslo je shodné s aktuálním heslem!";
                                break;
                            case "passNotSame":
                                echo "Hesla se neshodují!";
                                break;
                            case "wrongActualPass":
                                echo "Zadané heslo není správné!";
                                break;
                        }
                    }
                }
                ?>
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

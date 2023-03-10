<!DOCTYPE html>
<html>
<head>
    <title>Webhosting</title>
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/loginUzivZona.css">
</head>
<body>


<nav>
    <div class="header">
        <a class="noDecor" href="index.php">
            <img class="logoMain" src="img/logo.svg">
            W e b h o s t i n g
        </a>
    </div>
    <div class="divStretch"></div>

</nav>
<main>
    <div class="flexCenter">
        <div class="loginUzivMain">
            <form method="post" action="">
                <p class="uzivZonaNadpis">Ovládací panel
                </p>

                <input name="name" placeholder="Uživ. jméno" class="inputText" required type="text"><br>
                <input name="password" placeholder="Heslo" class="inputText" required type="password"><br>
                <div class="flexCenter">
                    <input class="inputSubmit" value="Přihlásit" name="loginUzivSubmit" type="submit">
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_COOKIE['logged_user_conpanel'])){
        header("Location: controlPanel.php");
    }

    if (isset($_POST['loginUzivSubmit'])) {
        $canLogin = true;
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            $canLogin = false;
        }
        if (isset($_POST['password'])) {
            $password =  $_POST['password'];
        } else {
            $canLogin = false;
        }

        if ($canLogin == true) {
            //login
            session_start();
            include "dbcon.php";
            $sqlUse = "use projekt";
            $sendUse = mysqli_query($conn, $sqlUse);
            $sql = "SELECT id, password FROM control_panel_users WHERE (login ='" . $name . "')";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $userFoundCount = mysqli_num_rows($result);

            if ($userFoundCount == 1) {
                if(password_verify($password, $row['password'])) {
                    $sql = "SELECT login FROM control_panel_users WHERE id = $row[id]";
                    $result = mysqli_query($conn, $sql);
                    $rowLogin = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $loginFromDB = $rowLogin['login'];
                    setcookie("logged_user_conpanel", $loginFromDB);
                    echo "Přihlášený jako: $_COOKIE[logged_user_conpanel]";
                    header("Location: controlPanel.php");
                }else {
                    echo "<script>alert('Špatné přihlašovací údaje.')</script>";
                }
            } else {
                echo "<script>alert('Špatné přihlašovací údaje.')</script>";
            }

        } else {
            echo "<script>alert('Špatné přihlašovací údaje.')</script>";
        }
    }
    ?>
</main>


</body>
</html>
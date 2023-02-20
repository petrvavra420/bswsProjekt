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
                <p class="uzivZonaNadpis">Uživatelská zóna
                </p>

                <input name="name" placeholder="Uživ. jméno nebo e-mail" class="inputText" required type="text"><br>
                <input name="password" placeholder="Heslo" class="inputText" required type="password"><br>
                <div class="flexCenter">
                    <input class="inputSubmit" value="Přihlásit" name="loginUzivSubmit" type="submit">
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['loginUzivSubmit'])) {
        $canLogin = true;
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        } else {
            $canLogin = false;
        }
        if (isset($_POST['password'])) {
            $name = $_POST['password'];
        } else {
            $canLogin = false;
        }

        if ($canLogin == true){
            //login jo
        }else {
            echo "Špatné přihlašovací údaje.";
        }
    }
    ?>
</main>


</body>
</html>
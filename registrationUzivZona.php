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
        <div  class="loginUzivMain">
            <form action="/bswsProjekt/registration.php" name="registrationForm"
                  method="post">
                <p class="uzivZonaNadpis">Uživatelská zóna
                </p>
                <p class="uzivZonaNadpis">Registrace
                </p>
                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == 1) {
                        echo '<div class="errorMessage"> Uživatelské jméno nebo email je zabráno!</div><br>';
                    } else if ($_GET["error"] == 2) {
                        echo '<div class="errorMessage"> Zadejte uživatelské jméno!</div><br>';
                    }else if ($_GET["error"] == 3) {
                        echo '<div class="errorMessage"> Zadejte heslo!</div><br>';
                    }else if ($_GET["error"] == 4) {
                        echo '<div class="errorMessage"> Zadejte email!</div><br>';
                    }else if ($_GET["error"] == 5) {
                        echo '<div class="errorMessage"> Neplatný email!</div><br>';
                    }else if ($_GET["error"] == 6) {
                        echo '<div class="errorMessage"> Hesla se neshodují!</div><br>';
                    }else{
                        echo '<div class="errorMessage"> Neznámý error!</div><br>';
                    }
                }
                ?>
                <input placeholder="Uživ. jméno" class="inputText" required type="text" name="fusername"><br>
                <input placeholder="E-mail" class="inputText" required type="text" name="femail"><br>
                <input placeholder="Heslo" class="inputText" required type="password"  name="fpassword"><br>
                <input placeholder="Potvrďte heslo" class="inputText" required type="password" name="fpassword2"><br>
                <div class="flexCenter">
                    <input class="inputSubmit" value="Registrovat" type="submit">
                </div>
            </form>
        </div>
    </div>
</main>


</body>
</html>
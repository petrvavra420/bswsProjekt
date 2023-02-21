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
            <form action="ondra_Exec.php" name="registrationForm"
                  method="post">
                <p class="uzivZonaNadpis">Uživatelská zóna
                </p>
                <p class="uzivZonaNadpis">Zvolte název domény
                </p>

                <input placeholder="Název domény" class="inputText" required type="text" name="fname"><br>
                <div class="flexCenter">
                    <input class="inputSubmit" value="ok" type="submit">
                </div>
            </form>
        </div>
    </div>
</main>


</body>
</html>
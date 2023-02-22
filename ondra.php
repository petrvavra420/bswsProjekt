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
            <form action="" name="form"
                  method="post">
                <p class="uzivZonaNadpis">Uživatelská zóna
                </p>
                <p class="uzivZonaNadpis">Zvolte název domény
                </p>

                <input placeholder="Název domény" class="inputText" required type="text" name="fname"><br>
                <input placeholder="Vytvořit sql databázi" type="checkbox" name="fdb">
                <div class="flexCenter">
                    <input class="inputSubmit" value="ok" type="submit" name="formSubmit">
                </div>
            </form>
        </div>
    </div>
</main>
<?php
if (isset($_POST['formSubmit'])) {

    if (isset($_POST['fname'])) {
        $domainName = $_POST["fname"];
        echo $domainName;
        if(isset($_POST['fdb'])){
            echo $_POST['fdb'];
        }
        //shell_exec( "command");
    }
}
?>


</body>
</html>
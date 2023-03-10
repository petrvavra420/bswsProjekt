<!DOCTYPE html>
<?php
if (isset($_POST['odhlasitConpanel'])) {
    setcookie("logged_user_conpanel", "", time() - 3600);
    unset($_COOKIE['logged_user_conpanel']);
    header("Location: index.php");

}

if (isset($_POST["passChangeConpanel"])) {
    header("Location: changePasswordForms/conpanelChangePass.php");
}

if (!isset($_COOKIE['logged_user_conpanel'])) {
    header("Location: loginControlPanel.php");
}

?>
<html>
<head>
    <?php
    session_start();
    if (!isset($_SESSION['what_i_need_to_load'])) {
        $_SESSION['what_i_need_to_load'] = "manage";

    }
    ?>
    <title>Webhosting</title>
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/loginUzivZona.css">
    <link rel="stylesheet" href="css/uzivZona.css">

    <script>
        function openTab(nazevZalozky) {

            if (nazevZalozky != null) {
                $.ajax({
                    url: 'controlPanelPages/ftp/set_session_value.php',
                    type: 'POST',
                    data: {what_i_need_to_load: nazevZalozky},
                });

                var tabcontent;

                tabcontent = document.getElementsByClassName("tabContent");

                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }


                document.getElementById(nazevZalozky).style.display = "block";

            }
        }

        /*function logout() {
            document.cookie = "is_logged=false";
            document.location.href = 'index.php';
            session_abort();

        }*/

        function logout() {
            // Call a PHP script using AJAX
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("GET", "logout/controlLogout.php", true);
            xhttp.send();
        }

        function openPhpMyAdmin() {
            location.href = "http://10.0.10.4/phpmyadmin/";
        }

        function openUserPanel() {
            location.href = "https://skola.pokus/loginUzivZona.php";
        }


    </script>


</head>
<body onload="openTab('<?php echo $_SESSION['what_i_need_to_load']; ?>')">


<nav>
    <div class="header">
        <a class="noDecorConpanel" href="index.php">
            <img class="logoMain" src="img/logo.svg">
            W e b h o s t i n g
        </a>
    </div>

    <div class="divStretch">
        <!-- P??ihl????en?? u??ivatel:
         --><?php
        /*        if (isset($_COOKIE['logged_user_conpanel'])) {
                    echo $_COOKIE['logged_user_conpanel'];
                }
                */ ?>
    </div>
    <div class="uzivZonaHeader">
        <button class="uzivZonaHeaderNadpis">Ovl??dac?? panel
            <div class="uzivZonaHeaderLoggedUser">
                <?php  echo $_COOKIE['logged_user_conpanel'];?>
            </div>
        </button>

    </div>

</nav>
<main class="uzivZonaMain">
    <aside>
        <button onclick="openTab('manage')">Spr??va</button>
        <button onclick="openTab('mysql')">MySQL termin??l</button>
        <button onclick="openPhpMyAdmin()">PhpMyAdmin</button>
        <button onclick="openUserPanel()">U??ivatelsk?? z??na</button>
        <button onclick="openTab('fileManager')">FTP p????stup</button>
        <form class="odhlasitForm" method="post">
            <input type="submit" value="Odhl??sit" name="odhlasitConpanel" class="odhlasitBtn">
        </form>


    </aside>
    <div id="manage" class="tabContent">
        <section>
            <span class="manageHeader">P??ihla??ovac?? jm??no do v??ech slu??eb je stejn?? jako do ovl??dac??ho panelu.</span><br>
            <span class="manageDesc">P??ihl????en?? u??ivatel: &nbsp;
            <span class="manageDescUser"><?php echo $_COOKIE['logged_user_conpanel'] ?></span>
                </span>

            <form class="passwordChangeConpanelForm" method="post">
                <input type="submit" value="Zm??nit heslo CONPANEL" name="passChangeConpanel" class="zmenaHeslaBtn">
            </form>
            <br>


            <form action="changePasswordForms/ftpChangePass.php" class="passwordChangeConpanelForm" method="post">
                <input type="submit" value="Zm??nit heslo FTP" name="passChangeFTP" class="zmenaHeslaBtn">
            </form>
            <br>


            <form action="changePasswordForms/dbChangePass.php" class="passwordChangeConpanelForm" method="post">
                <input type="submit" value="Zm??nit heslo PhpMyAdmin" name="passChangeDB" class="zmenaHeslaBtn">
            </form>


        </section>
    </div>
    <div id="mysql" class="tabContent">
        <section class="flexCenter">
            <?php
            include("controlPanelPages/mysql/mysql.php");
            ?>
        </section>
    </div>

    <div id="fileManager" class="tabContent">
        <section>
            <?php
            if (isset($_COOKIE['logged_user_conpanel'])) {
                include("dbcon.php");
                $sqlUse = "use projekt";
                $sendUse = mysqli_query($conn, $sqlUse);

                $service_username = $_COOKIE['logged_user_conpanel']; // Potrebuju ziskat uz. jmeno dane sluzby
                $sql = "SELECT username FROM control_panel_users LEFT JOIN uz_zona_login ON control_panel_users.uz_zona_login_id = uz_zona_login.id WHERE login =" . '"' . $service_username . '"';

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        $username = $row["username"];
                    }
                }

                $sql = "SELECT domain_name FROM control_panel_users WHERE login =" . '"' . $service_username . '"';
                $result = mysqli_query($conn, $sql);
                $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $domain_name = $resultArray['domain_name'];

                define('FM_EMBED', true);
                define('FM_DOMAIN_NAME', $domain_name);
                include("controlPanelPages/ftp/explorer.php");

            }


            ?>
        </section>
    </div>


</main>


</body>

</html>

<script>


</script>

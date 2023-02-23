<!DOCTYPE html>
<html>
<head>
<?php
session_start();
?>
    <title>Webhosting</title>
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/loginUzivZona.css">
    <link rel="stylesheet" href="css/uzivZona.css">

    <script>
    function openTab(nazevZalozky) {

        if (nazevZalozky != null){
            $.ajax({
            url: 'set_session_value.php',
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

    function logout() {
        document.cookie = "is_logged=false";
        document.location.href = 'index.php';
        session_abort();

    }
</script>



</head>
<body onload="openTab('<?php echo $_SESSION['what_i_need_to_load'];?>')">



<nav>
    <div class="header">
        <a class="noDecor" href="index.php">
            <img class="logoMain" src="img/logo.svg">
            W e b h o s t i n g
        </a>
    </div>

    <div class="divStretch"> Přihlášený uživatel:
        <?php
        if (isset($_COOKIE['logged_user_conpanel'])) {
            echo $_COOKIE['logged_user_conpanel'];
        }
        ?>
    </div>
    <div class="uzivZonaHeader">
        <button class="uzivZonaHeaderNadpis">Ovládací panel</button>

    </div>

</nav>
<main class="uzivZonaMain">
    <aside>
        <button onclick="openTab('manage')">Správa</button>
        <button onclick="openTab('mysql')">MySQL</button>
        <button onclick="openTab('fileManager')">FTP přístup</button>
        <button onclick="document.location='logout/controlLogout.php'">Odhlásit</button>
    </aside>
    <div id="manage" class="tabContent">
        <section>
            content1
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
            
            $service_username = $_COOKIE['logged_user_conpanel']; // Potrebuju ziskat uz. jmeno dane sluzby
            $username =  $_COOKIE['logged_user']; // Potrebuju ziskat uz. jmeno

            define('FM_EMBED', true);
            define('FM_USER', $username);
            define('FM_SER_USER', $service_username);
            include("explorer.php");
            
        ?>
        </section>
    </div>


</main>



</body>

</html>


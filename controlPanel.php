<!DOCTYPE html>
<html>
<head>
    <title>Webhosting</title>
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/loginUzivZona.css">
    <link rel="stylesheet" href="css/uzivZona.css">
</head>
<body>


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
        <button onclick="openTab(event, 'manage')" id="defaultOpen">Správa</button>
        <button onclick="openTab(event, 'mysql')">MySQL</button>
        <button onclick="openTab(event, 'serviceList')" >FTP přístup</button>
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

    <!-- TODO kdyz tu je jen tento div 'serviceList', tak vse funguje, ale kdyz tu jsou vsechny a v tomho divu ve filemanageru na neco kliku 
        cele se to pokazi -->
    <div id="serviceList" class="tabContent">
        <section>
            <?php
            $service_username = "sluzba"; // Potrebuju ziskat uz. jmeno dane sluzby
            $username = "admin"; // Potrebuju ziskat uz. jmeno

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

<script>
    function openTab(evt, nazevZalozky) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabContent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tabLinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(nazevZalozky).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function logout() {
        document.cookie = "is_logged=false";
        document.location.href = 'index.php';

    }

    document.getElementById("defaultOpen").click();
</script>
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
        if (isset($_COOKIE['logged_user']))
            echo $_COOKIE['logged_user'];
        ?>
    </div>
    <div class="uzivZonaHeader">
        <button class="uzivZonaHeaderNadpis">Uživatelská zóna</button>

    </div>

</nav>
<main class="uzivZonaMain">
    <aside>
        <button class="tabLinks" onclick="openTab(event, 'orderService')" id="defaultOpen">Objednat službu</button>
        <button class="tabLinks" onclick="openTab(event, 'serviceList')">Přehled vašich služeb</button>
        <button class="tabLinks" onclick="openTab(event, 'payments')">Platby</button>
        <button class="tabLinks" onclick="openTab(event, 'account')">Účet</button>
        <button class="tabLinks" id="logoutTab" onclick="logout()">Odhlásit </button>
    </aside>

    <div id="orderService" class="tabContent">
        <section>
            content1
        </section>
    </div>
    <div id="serviceList" class="tabContent">
        <section>
            content2
        </section>
    </div>
    <div id="payments" class="tabContent">
        <section>
            content3
        </section>
    </div>
    <div id="account" class="tabContent">
        <section>
            content4
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

    function logout(){
        document.cookie = "is_logged=false";
        document.location.href='index.php';

    }

    document.getElementById("defaultOpen").click();
</script>
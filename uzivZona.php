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
        <button class="tabLinks" id="logoutTab" onclick="logout()">Odhlásit</button>
    </aside>

    <div id="orderService" class="tabContent">
        <section>
            <div class="flexCenter">
                <form action="" name="form"
                      method="post">
                    <p class="uzivZonaNadpis">Zvolte název domény
                    </p>

                    <input placeholder="Název domény" class="inputText" required type="text" name="fname"><br>
                    <input type="checkbox" name="fdb" checked value="chce!" id="checkbox">
                    <label for="checkbox">Vytvořit SQL databázi <br></label>
                    <p class="uzivZonaNadpis">Přihlašovací udaje k doméně
                    </p>
                    <input placeholder="Uživ. jméno" class="inputText" required type="text" name="fusername"><br>
                    <input placeholder="Heslo" class="inputText" required type="password" name="fpassword"><br>
                    <input placeholder="Potvrďte heslo" class="inputText" required type="password"
                           name="fpassword2"><br>
                    <div class="flexCenter">
                        <input class="inputSubmit" value="ok" type="submit" name="orderFormSubmit">
                    </div>
                </form>
            </div>

            <?php
            include 'dbcon.php';
            if (isset($_POST['orderFormSubmit'])) {

                $domainName = $_POST['fname'];
                $wantDb = isset($_POST['fdb']);
                $username = $_POST['fusername'];
                $password = $_POST['fpassword'];
                $password2 = $_POST['fpassword2'];
                $usernameMain = $_COOKIE['logged_user'];

                //domain_name check
                if (preg_match('/^[a-z]+$/', $domainName) && strlen($domainName) <= 30) {
                    mysqli_query($conn, "use projekt");
                    $sql = "SELECT domain_name FROM control_panel_users WHERE login='$domainName'";
                    $result = mysqli_query($conn, $sql);
                } else {
                    echo "<script>alert('Neplatná doména! Zadejte pouze malá písmena bez mezer! Maximálně 30 znaků!')</script>";
                    return;
                }

                if (mysqli_num_rows($result) != 0) {
                    echo "<script>alert('Tato doména je již zabraná!')</script>";
                    return;
                }

                //username, password check
                if ($password != $password2) {
                    echo "<script>alert('Hesla se neshodují!')</script>";
                    return false;
                }

                $sql = "SELECT id FROM uz_zona_login WHERE username='$usernameMain'";
                $result = mysqli_query($conn, $sql);
                $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $id = $resultArray['id'];

                $sql = "SELECT login FROM control_panel_users WHERE login='$username'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 0) {
                    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                    $statement = $conn->prepare("insert into control_panel_users(login, password, domain_name, uz_zona_login_id) values(?,?,?,?) ");
                    $statement->bind_param("ssss", $username, $passwordHashed, $domainName, $id);
                    $statement->execute();
                    $statement->close();
                } else {
                    echo "<script>alert('Toto uživatelské jméno je zabrané!')</script>";
                    return;
                }

                shell_exec("/srv/Sdileno/.scripts/new_domain.sh $domainName $usernameMain $password $wantDb $username '$passwordHashed'");

            }
            ?>
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

    function logout() {
        document.cookie = "is_logged=false";
        document.location.href = 'index.php';

    }

    document.getElementById("defaultOpen").click();
</script>
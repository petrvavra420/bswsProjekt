<?php
ob_start();
?>
    <!DOCTYPE html>
    <?php
    if (isset($_POST['odhlasitUzivzona'])) {
        setcookie("logged_user", "", time() - 3600);
        unset($_COOKIE['logged_user']);
        header("Location: index.php");
    }

    ?>
    <html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?php
        session_start();
        if (!isset($_SESSION['what_i_need_to_load_uziv'])) {
            $_SESSION['what_i_need_to_load_uziv'] = "orderService";

        }
        ?>
        <title>Webhosting</title>
        <link rel="stylesheet" href="css/mainPage.css">
        <link rel="stylesheet" href="css/loginUzivZona.css">
        <link rel="stylesheet" href="css/uzivZona.css">
        <link rel="stylesheet" href="css/loader.css">

        <script>
            function openTab(nazevZalozky) {

                if (nazevZalozky != null) {
                    $.ajax({
                        url: 'controlPanelPages/ftp/set_session_value.php',
                        type: 'POST',
                        data: {what_i_need_to_load_uziv: nazevZalozky},
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
        </script>

    </head>
    <body onload="openTab('<?php echo $_SESSION['what_i_need_to_load_uziv']; ?>')">


    <nav>
        <div class="header">
            <a class="noDecor" href="index.php">
                <img class="logoMain" src="img/logo.svg">
                W e b h o s t i n g
            </a>
        </div>

        <div class="divStretch">
            <?php
            if (isset($_COOKIE['logged_user'])) {

            } else {
                echo "test";
                header("Location: loginUzivZona.php");
            }
            ?>
        </div>
        <div class="uzivZonaHeader">
            <button class="uzivZonaHeaderNadpis">Uživatelská zóna
                <div class="uzivZonaHeaderLoggedUser">
                    <?php echo $_COOKIE['logged_user']; ?>
                </div>
            </button>

        </div>

    </nav>
    <main class="uzivZonaMain">
        <aside>
            <button onclick="openTab('orderService')">Objednat službu</button>
            <button onclick="openTab('serviceList')">Přehled vašich služeb</button>
            <button onclick="openTab('payments')">Platby</button>
            <button onclick="openTab('account')">Účet</button>
            <form class="odhlasitForm" method="post">
                <input type="submit" value="Odhlásit" name="odhlasitUzivzona" class="odhlasitBtn">
            </form>
        </aside>

        <div id="orderService" class="tabContent">
            <section>
                <div class="flexCenter">
                    <form action="" name="form" method="post" onsubmit="showLoader()">

                        <div class="flexCenter">
                            <p class="uzivZonaNadpis">Zvolte název domény
                            </p>
                        </div>
                        <div class="flexCenter" id="marginInput">
                            <input placeholder="Název domény" class="inputText" required type="text" name="fname"><br>
                        </div>
                        <div class="flexCenter">
                            <input type="checkbox" name="fdb" checked value="chce!" id="checkbox">

                            <label id="marginInput" for="checkbox">Vytvořit SQL databázi <br></label>
                        </div>
                        <div class="flexCenter">
                            <p class="uzivZonaNadpis">Přihlašovací udaje k doméně
                            </p>
                        </div>
                        <div class="flexCenter" id="marginInput">
                            <input placeholder="Uživ. jméno" class="inputText" required type="text"
                                   name="fusername"><br>
                        </div>
                        <div class="flexCenter" id="marginInput">
                            <input placeholder="Heslo" class="inputText" required type="password" name="fpassword"><br>
                        </div>
                        <div class="flexCenter" id="marginInput">
                            <input placeholder="Potvrďte heslo" class="inputText" required type="password"
                                   name="fpassword2">
                        </div>
                        <br>

                        <div class="flexCenter">
                            <input class="inputSubmit" value="Objednat službu" type="submit" name="orderFormSubmit">
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

                    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
                    if (mysqli_num_rows($result) == 0) {
                        $statement = $conn->prepare("insert into control_panel_users(login, password, domain_name, uz_zona_login_id) values(?,?,?,?) ");
                        $statement->bind_param("ssss", $username, $passwordHashed, $domainName, $id);
                        $statement->execute();
                        $statement->close();
                    } else {
                        echo "<script>alert('Toto uživatelské jméno je zabrané!')</script>";
                        return;
                    }
                    if (isset($_POST['fdb'])) {
                        $sql = "SELECT id FROM control_panel_users WHERE login='$username'";
                        $result = mysqli_query($conn, $sql);
                        $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $id = $resultArray['id'];

                        $statement = $conn->prepare("insert into database_users(login, password, database_name, id_control_panel_user) values(?,?,?,?) ");
                        $statement->bind_param("ssss", $username, $password, $domainName, $id);
                        $statement->execute();
                        $statement->close();
                    }

                    shell_exec("/srv/Sdileno/.scripts/new_domain.sh $domainName $usernameMain $password $wantDb $username '$passwordHashed'");
                    echo "<script>alert('Doména vytvořna.')</script>";
                }
                ?>
            </section>
        </div>
        <div id="serviceList" class="tabContent">
            <section>
                <?php
                include 'dbcon.php';
                mysqli_query($conn, "use projekt");
                $usernameMain = $_COOKIE['logged_user'];

                $sql = "SELECT domain_name, login FROM control_panel_users LEFT JOIN uz_zona_login ON uz_zona_login.id = control_panel_users.uz_zona_login_id WHERE username = '$usernameMain'";
                $result = mysqli_query($conn, $sql);
                ?>

                <div class="block-container">
                    <?php foreach ($result as $block): ?>
                        <div class="block" id="serviceDiv">

                            <form class="serviceForm" method="post" name="deleteForm">
                                <span class="serviceBtnFloatRight">
                                    <a class="domainLink" href="<?php echo 'https://'.$block['domain_name'].'.skola.pokus';?>"><span class="serviceName"><?php echo $block['domain_name']; ?> <span class="serviceDomainName">.skola.pokus</span></span></a>
                                    <span class="serviceBtnSpan">
                                    <button onclick="showLoader()" class="servicesBtn" name="gotoUzivZona"
                                            value="<?php echo $block['domain_name']; ?>">
                                    Ovládací panel
                                    </button>
                                    <button onclick="showLoader()" class="servicesBtn" name="delete"
                                            value="<?php echo $block['domain_name']; ?>">
                                    Smazat
                                    </button>
                                        </span>
                                </span>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php
                mysqli_query($conn, "use projekt");
                if (isset($_POST['delete'])) {
                    $domain_name = $_POST['delete'];
                    $sql = "SELECT login FROM control_panel_users WHERE domain_name = '$domain_name'";
                    $result = mysqli_query($conn, $sql);
                    $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $login = $resultArray['login'];

                    shell_exec("/srv/Sdileno/.scripts/remove_domain.sh $domain_name $usernameMain $login");
                    $sql = "DELETE FROM control_panel_users WHERE login = '$login'";
                    $result = mysqli_query($conn, $sql);
                    $sql = "DELETE FROM database_users WHERE login = '$login'";
                    $result = mysqli_query($conn, $sql);
                    header('Location: ' . $_SERVER['REQUEST_URI']);
                }
                if (isset($_POST['gotoUzivZona'])) {
                    $domain_name = $_POST['gotoUzivZona'];
                    $sql = "SELECT login FROM control_panel_users WHERE domain_name = '$domain_name'";
                    $result = mysqli_query($conn, $sql);
                    $resultArray = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $login = $resultArray['login'];
                    setcookie("logged_user_conpanel", $login);
                    header("Location: loginControlPanel.php");
                }

                ?>
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

    <!-- Loader animaces -->
    <div class="backgroundCoverLoading" id="backgroundCoverLoading"></div>
    <div id="loader" class="loadingspinner">
        <div id="square1"></div>
        <div id="square2"></div>
        <div id="square3"></div>
        <div id="square4"></div>
        <div id="square5"></div>
    </div>

    </body>
    </html>


    <script type="text/javascript">
        //loader
        function showLoader() {
            document.getElementById("loader").style.display = "block";
            document.getElementById("backgroundCoverLoading").style.display = "block";

        }

        //refresh page when user uses the browser go back button
        window.addEventListener("pageshow", function (event) {
            var historyTraversal = event.persisted ||
                (typeof window.performance != "undefined" &&
                    window.performance.navigation.type === 2);
            if (historyTraversal) {
                // Handle page restore.
                window.location.reload();
            }
        });

    </script>
<?php
ob_end_flush();
?>
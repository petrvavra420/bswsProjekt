<?php
if (isset($_COOKIE['logged_user_conpanel'])) {
    echo "cokie: ".$_COOKIE['logged_user_conpanel'];
    setcookie("logged_user_conpanel","",time()-3600);

    unset($_COOKIE['logged_user_conpanel']);
    setcookie('logged_user_conpanel', null, -1, '/');
    echo $_COOKIE['logged_user_conpanel'];
//    header("Location: ../index.php");
}else {
    echo "cookie not found, redirecting..";
}
?>
<html>
<body>

</body>
</html>

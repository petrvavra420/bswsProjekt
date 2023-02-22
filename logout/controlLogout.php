<?php
if (isset($_COOKIE['logged_user_conpanel'])) {
    setcookie("logged_user_conpanel","",time()-3600);
    header("Location: ../index.php");
}else {
    echo "cookie not found, redirecting..";
}
?>
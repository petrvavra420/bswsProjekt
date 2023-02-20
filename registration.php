<?php
include("dbcon.php");

$username = $_POST["fusername"];
$password = $_POST["fpassword"];
$password2 = $_POST["fpassword2"];
$email = $_POST["femail"];

if (!validate($username, $password, $password2, $email)) {
    echo "chyba";
}


mysqli_query($conn, "use projekt");
$sql = "SELECT username, email FROM uz_zona_login WHERE username='$username' OR email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $statement = $conn->prepare("insert into uz_zona_login(username, password, email) values(?,?,?) ");
    $statement->bind_param("sss", $username, $password, $email);
    $statement->execute();
    $statement->close();
    header("Location: index.php");
} else {
    header("Location: registrationUzivZona.php?error=1");
}

function validate($username, $password, $password2, $email)
{
    if ($username == "") {
        header("Location: registrationUzivZona.php?error=2");
        return false;
    }
    if ($password == "") {
        header("Location: registrationUzivZona.php?error=3");
        return false;
    }

    if($password != $password2){
        header("Location: registrationUzivZona.php?error=6");
        return false;
    }

    if ($email == "") {
        header("Location: registrationUzivZona.php?error=4");
        return false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: registrationUzivZona.php?error=5");
        return false;
    }
    return true;
}
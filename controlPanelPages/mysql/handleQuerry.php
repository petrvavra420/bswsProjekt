<?php
if (isset($_POST['sql'])) {
    include_once("../../dbcon.php");
    $sqlUse = "use projekt";
    $sendUse = mysqli_query($conn, $sqlUse);
    $sqlGetCreds = "SELECT database_users.login,database_users.password,database_name FROM database_users LEFT JOIN control_panel_users ON database_users.id_control_panel_user = control_panel_users.id WHERE control_panel_users.login = '$_COOKIE[logged_user_conpanel]'";
    $result = mysqli_query($conn,$sqlGetCreds);
    $row = mysqli_fetch_assoc($result);


    $servername = "10.0.10.4:3306";
    $usernameDBUser = $row['login'];
    $passwordDBUser = $row['password'];
    $databaseNameUser = $row['database_name'];

// Create connection
    $connUser = mysqli_connect($servername, $usernameDBUser, $passwordDBUser);
    $sqlUse = "use ".$databaseNameUser;
    $sendUse = mysqli_query($connUser, $sqlUse);




    $sql = $_POST['sql'];
    $result = mysqli_query($connUser, $sql);

    if (is_array($sql)) $sql = key($sql);

    $matches = null;
    if (!preg_match('/^\s*(SELECT|INSERT|REPLACE|UPDATE|DELETE|TRUNCATE|CALL|DO|HANDLER|LOAD\s+(?:DATA|XML)\s+INFILE|(?:ALTER|CREATE|DROP|RENAME)\s+(?:DATABASE|TABLE|VIEW|FUNCTION|PROCEDURE|TRIGGER|INDEX)|PREPARE|EXECUTE|DEALLOCATE\s+PREPARE|DESCRIBE|EXPLAIN|HELP|USE|LOCK\s+TABLES|UNLOCK\s+TABLES|SET|SHOW|START\s+TRANSACTION|BEGIN|COMMIT|ROLLBACK|SAVEPOINT|RELEASE SAVEPOINT|CACHE\s+INDEX|FLUSH|KILL|LOAD|RESET|PURGE\s+BINARY\s+LOGS|START\s+SLAVE|STOP\s+SLAVE)\b/si', $sql, $matches)) return null;

    $type = strtoupper(preg_replace('/\s++/', ' ', $matches[1]));
    if ($type === 'BEGIN') $type = 'START TRANSACTION';


    if ($type == "SELECT") {

        // Check if the query was successful.
        if (!$result) {
            die('Invalid query: ' . mysqli_error($conn));
        }

// Get the field names of the table and store them in an array.

        $field_names = array();
        while ($field = mysqli_fetch_field($result)) {
            $field_names[] = $field->name;
        }

// Output the field names as the header row of a table.
        echo '<table>';
        echo '<tr>';
        foreach ($field_names as $field_name) {
            echo '<th>' . $field_name . '</th>';
        }
        echo '</tr>';

// Output the data from the result set in a table.
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    }

    if (!$result) {
        die('Invalid query: ' . mysqli_error($connUser));
    } else {

        switch ($type) {
            case "DELETE":
                echo  mysqli_affected_rows($connUser)." rows deleted.";
                break;
            case "INSERT":
                echo  mysqli_affected_rows($connUser)." rows inserted.";
                break;
            case "UPDATE":
                echo  mysqli_affected_rows($connUser)." rows updated.";
                break;
            case "SELECTED":
                echo mysqli_affected_rows($connUser) . " rows selected.";
                break;
            default:
                echo  mysqli_affected_rows($connUser)." rows affected, querry completed succesfully.";
        }

    }

}
?>
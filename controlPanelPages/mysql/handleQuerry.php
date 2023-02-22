<?php
if (isset($_POST['sql'])) {
    include_once("../../dbcon.php");
    $sqlUse = "use projekt";
    $sendUse = mysqli_query($conn, $sqlUse);

    $sql = $_POST['sql'];
    $result = mysqli_query($conn, $sql);

    if (is_array($sql)) $sql = key($sql);

    $matches = null;
    if (!preg_match('/^\s*(SELECT|INSERT|REPLACE|UPDATE|DELETE|TRUNCATE|CALL|DO|HANDLER|LOAD\s+(?:DATA|XML)\s+INFILE|(?:ALTER|CREATE|DROP|RENAME)\s+(?:DATABASE|TABLE|VIEW|FUNCTION|PROCEDURE|TRIGGER|INDEX)|PREPARE|EXECUTE|DEALLOCATE\s+PREPARE|DESCRIBE|EXPLAIN|HELP|USE|LOCK\s+TABLES|UNLOCK\s+TABLES|SET|SHOW|START\s+TRANSACTION|BEGIN|COMMIT|ROLLBACK|SAVEPOINT|RELEASE SAVEPOINT|CACHE\s+INDEX|FLUSH|KILL|LOAD|RESET|PURGE\s+BINARY\s+LOGS|START\s+SLAVE|STOP\s+SLAVE)\b/si', $sql, $matches)) return null;

    $type = strtoupper(preg_replace('/\s++/', ' ', $matches[1]));
    if ($type === 'BEGIN') $type = 'START TRANSACTION';

    echo $type;

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
        die('Invalid query: ' . mysqli_error($conn));
    } else {

        switch ($type) {
            case "DELETE":
                echo  mysqli_affected_rows($conn)." rows deleted.";
                break;
            case "INSERT":
                echo  mysqli_affected_rows($conn)." rows inserted.";
                break;
            case "UPDATE":
                echo  mysqli_affected_rows($conn)." rows updated.";
                break;
            case "SELECTED":
                echo mysqli_affected_rows($conn) . " rows selected.";
                break;
            default:
                echo  mysqli_affected_rows($conn)." rows affected, querry completed succesfully.";
        }

    }

}
?>
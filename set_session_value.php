<?php
session_start();

if (isset($_POST['what_i_need_to_load'])) {
  $_SESSION['what_i_need_to_load'] = $_POST['what_i_need_to_load'];
  echo 'Session value set successfully.';
}
?>

<?php
session_start();

if (isset($_POST['what_i_need_to_load'])) {
  $_SESSION['what_i_need_to_load'] = $_POST['what_i_need_to_load'];
}

if (isset($_POST['what_i_need_to_load_uziv'])) {
  $_SESSION['what_i_need_to_load_uziv'] = $_POST['what_i_need_to_load_uziv'];
}
?>

<?php
  session_start();
  session_unset();
  session_destroy();
  header('Location: /joyeria/joyeria_php/login.php');
?>
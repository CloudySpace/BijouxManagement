<?php
  session_start();
  require 'conexion.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, id_perfil, name, password FROM empleado WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if ($results && count($results) > 0) {
      $user = $results;
      if($results['id_perfil'] == 1) {
        header('Location: /joyeria/joyeria_php/index.php');
      }
      else if($results['id_perfil'] == 2) {
        header('Location: /joyeria/joyeria_php/indexEmpleado.php');
      }
    }
  }
?>

<?php
  session_start();
  require 'conexion.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, id_perfil, name, password,id_almacen FROM empleado WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if ($results && count($results) > 0) {
      $user = $results;
      if($results['id_perfil'] == 1) {
        header('Location: ../site/home.php');
      }
      else if($results['id_perfil'] == 2) {
        header('Location: ../site/homeEmpleado.php');
      }
    }
  }
?>

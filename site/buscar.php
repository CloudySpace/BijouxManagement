<?php
  session_start();
  require 'conexion.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, id_perfil, name, username, password, id_Almacen FROM empleado WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    $messageUsuario = '';
    $messageUsername = '';
    if ($results && count($results) > 0) {
        $user = $results;
        $busqued = $user['id_Almacen'];
        
        if (!empty($_POST['search'])){
        $filtro = '%'.$_POST['search'].'%';
        $link = mysqli_connect("localhost", "root", "", "joyeria") or die ('Error de conexion: ' . mysqli_error());
        $result_filtro =  mysqli_query($link,"SELECT registro.fecha_actualizacion, empleado.name as nombre, material.name, registro.peso, material.quilataje, registro.estado, material.id as id_material, empleado.id as id_empleado FROM material,registro,empleado WHERE registro.id_Almacen = '$busqued' and material.id_Almacen = '$busqued' and empleado.id_Almacen = '$busqued' and material.id = registro.id_material and empleado.id = registro.id_empleado and (registro.fecha_actualizacion LIKE '$filtro' or registro.estado LIKE '$filtro' or empleado.name LIKE '$filtro') ORDER BY registro.fecha_actualizacion DESC");   
        }
    }
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Bijoux Management</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="images/icon/logo.png" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="home.php">
                                <i class="fas fa-tachometer-alt"></i>Overview</a>
                        </li>
                        <li>
                            <a href="material.php">
                                <i class="fas fa-table"></i>Materiales</a>
                        </li>
                        <li>
                            <a href="empleado.php">
                                <i class="far fa-check-square"></i>Empleados</a>
                        </li>
                        <li>
                            <a href="historial.php">
                                <i class="fas fa-archive"></i>Historial</a>
                        </li>
                        <li class="active has-sub">
                            <a href="buscar.php">
                                <i class="fas fa-search"></i>Buscar en Historial</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="buscar.php" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Buscar por fecha, estado o empleado " />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/admin.png" alt="Admin" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn">
                                                <?= $user['name']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <img src="images/admin.png" alt="Admin" />
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <?php if(!empty($user)): ?>
                                                        <a href="#">
                                                            <?= $user['name']; ?></a>
                                                        <?php endif; ?>
                                                    </h5>
                                                    <?php if(!empty($user)): ?>
                                                    <span class="email">
                                                        <?= $user['username']; ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <?php if(empty($user)): ?>
                                                    <a href="login.php">
                                                        <i class="zmdi zmdi-account"></i>Login</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <?php if(!empty($user)): ?>
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Fecha</th>
                                                <th>ID Empleado</th>
                                                <th>Nombre Empleado</th>
                                                <th class="text-right">ID Material</th>
                                                <th class="text-right">Nombre Material</th>
                                                <th class="text-right">Peso</th>
                                                <th class="text-right">Quilataje</th>
                                                <th class="text-right">Estado</th>
                                            </tr>
                                        </thead>
                                        <?php if(isset($result_filtro)): ?>
                                            <?php while($row = mysqli_fetch_assoc($result_filtro)){
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td><?= $row['fecha_actualizacion'] ?></td>
                                                <td><?= $row['id_empleado'] ?></td>
                                                <td><?= $row['nombre'] ?></td>
                                                <td><?= $row['id_material'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td class="text-right"><?= $row['peso'] ?></td>
                                                <td class="text-right"><?= $row['quilataje'] ?></td>
                                                <td class="text-right"><?= $row['estado'] ?></td>
                                            </tr>
                                        </tbody>
                                        <?php
                                            }
                                        ?>
                                        <?php endif; ?>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->
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
    $error = '';
    if ($results && count($results) > 0) {
        $user = $results;
        $busqued = $user['id_Almacen'];
        $link = mysqli_connect("localhost", "root", "", "joyeria") or die ('Error de conexion: ' . mysqli_error());
        $resultado = mysqli_query($link,"SELECT * FROM empleado WHERE id_Almacen = '$busqued' and id_perfil = 2");
        
        if(!empty($_POST['usuario']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['perfil'])){
            $existe = $conn->prepare('SELECT * FROM empleado WHERE username = :username');
            $existe->bindParam(':username', $_POST['username']);
            $existe->execute();
            $existe = $existe->fetch(PDO::FETCH_ASSOC);
            $converPerfil = $_POST['perfil'];
            $a = floatval($converPerfil);
            if ((!$existe)  && ($a == 1 or $a == 2)){
                $sql = "INSERT INTO empleado (id_perfil, name, username, password, id_Almacen ) VALUES (:id_perfil, :name, :username, :password, :id_Almacen)"; 
                $insert = $conn->prepare($sql);
                $insert->bindParam(':id_perfil', $_POST['perfil']);
                $insert->bindParam(':name', $_POST['usuario']);
                $insert->bindParam(':username', $_POST['username']);
                $insert->bindParam(':password', $_POST['password']);
                $insert->bindParam(':id_Almacen', $user['id_Almacen']);
                $insert->execute();
                header("Location: actualizar.php");
            }
            else{
                $error = '1';
            }
        }
        else if(!empty($_POST['eliminar']) ){
            $existe = $conn->prepare('SELECT * FROM empleado WHERE id = :id');
            $existe->bindParam(':id', $_POST['eliminar']);
            $existe->execute();
            $existe = $existe->fetch(PDO::FETCH_ASSOC);
            if (($existe)  && ($user['id'] != $_POST['eliminar'])){
                $sql = "DELETE FROM empleado WHERE id = :id"; 
                $delete = $conn->prepare($sql);
                $delete->bindParam(':id', $_POST['eliminar']);
                $delete->execute();
                header("Location: actualizar.php");
            }
            else{
                $error = '1';
            }
        }
        else if(!empty($_POST['m_id']) && !empty($_POST['m_usuario']) && !empty($_POST['m_username']) && !empty($_POST['m_password']) && !empty($_POST['m_perfil'])){
            $existe = $conn->prepare('SELECT * FROM empleado WHERE id = :id');
            $existe->bindParam(':id', $_POST['m_id']);
            $existe->execute();
            $existe = $existe->fetch(PDO::FETCH_ASSOC);
            if ($existe && count($existe) > 0){
                $existe = $conn->prepare('SELECT * FROM empleado WHERE username = :username');
                $existe->bindParam(':username', $_POST['m_username']);
                $existe->execute();
                $existe = $existe->fetch(PDO::FETCH_ASSOC);
                $converPerfil = $_POST['m_perfil'];
                $a = floatval($converPerfil);
                if ((!$existe)  && ($a == 1 or $a == 2)){
                    $sql = "UPDATE empleado SET name = :name, username = :username, password = :password, id_perfil = :id_perfil WHERE id = :id"; 
                    $update = $conn->prepare($sql);
                    $update->bindParam(':name', $_POST['m_usuario']);
                    $update->bindParam(':username', $_POST['m_username']);
                    $update->bindParam(':password', $_POST['m_password']);
                    $update->bindParam(':id_perfil', $_POST['m_perfil']);
                    $update->bindParam(':id', $_POST['m_id']);
                    $update->execute();
                    header("Location: actualizar.php");
                }
                else{
                    $error = '1';
                }       
            }
            else{
                $error = '1';
            }
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;    
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }
    </style>
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
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/fontawesome-free-5.5.0-web/fontawesome-free-5.5.0-web/css/fontawesome.css" rel="stylesheet" media="all">
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
    <link href="css/style.css" rel="stylesheet" media="all">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="css/tabs.css" rel="stylesheet" media="all">
    <link href="css/tab-menus.css" rel="stylesheet" media="all">

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
                        <li class="active has-sub">
                            <a href="empleado.php">
                                <i class="far fa-check-square"></i>Empleados</a>
                        </li>
                        <li>
                            <a href="historial.php">
                                <i class="fas fa-archive"></i>Historial</a>
                        </li>
                        <li>
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
                            <form class="form-header" action="" method="POST">

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
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <?php if(!empty($error)): ?>
                        <div class="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <strong>ERROR</strong> Los datos son invalidos.
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="title-1 m-b-25">Empleados</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>ID Empleado</th>
                                                <th>Nombre Empleado</th>
                                                <th>Username</th>
                                                <th>Password</th>

                                            </tr>
                                        </thead>
                                        <?php if(isset($resultado)): ?>
                                        <?php while($row = mysqli_fetch_assoc($resultado)){
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <?= $row['id'] ?>
                                                </td>
                                                <td>
                                                    <?= $row['name'] ?>
                                                </td>
                                                <td>
                                                    <?= $row['username'] ?>
                                                </td>
                                                <td>
                                                    <?= $row['password'] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php
                                            }
                                        ?>
                                        <?php endif; ?>
                                    </table>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="admintab-wrap mg-b-40">
                                    <ul class="nav nav-tabs custom-menu-wrap custon-tab-menu-style1" style="color:#cccc">
                                        <li><a data-toggle="tab" href="#Agregar"><span class="adminpro-icon adminpro-analytics tab-custon-ic"></span>Agregar</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#Eliminar"><span class="adminpro-icon adminpro-analytics-arrow tab-custon-ic"></span>Eliminar</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#Modificar"><span class="adminpro-icon adminpro-analytics-bridge tab-custon-ic"></span>Modificar</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="Agregar" class="tab-pane in active animated flipInX custon-tab-style1">
                                            <div class="card">
                                                <div class="card-body card-block">
                                                    <form action="empleado.php" method="post">
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="text" name="usuario"
                                                                id="user" placeholder="Nombre">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="text" name="username"
                                                                id="user" placeholder="Username">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="password3"
                                                                name="password" id="password3" placeholder="Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="user" name="perfil"
                                                                id="user" placeholder="Perfil">
                                                        </div>
                                                        <div class="form-actions form-group">
                                                            <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20">Listo</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Eliminar" class="tab-pane animated flipInX custon-tab-style1">
                                            <div class="card">
                                                <div class="card-body card-block">
                                                    <form action="empleado.php" method="post">
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="text" name="eliminar"
                                                                id="user" placeholder="ID">
                                                        </div>
                                                        <div class="form-actions form-group">
                                                            <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20">Listo</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="Modificar" class="tab-pane animated flipInX custon-tab-style1">
                                            <div class="card">
                                                <div class="card-body card-block">
                                                    <form action="empleado.php" method="post">
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="text" name="m_id" id="user"
                                                                placeholder="ID">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="text" name="m_usuario" id="user"
                                                                placeholder="Nombre">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="text" name="m_username" id="user"
                                                                placeholder="Username">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="password3" name="m_password"
                                                                id="password3" placeholder="Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <input class="au-input au-input--full" type="user" name="m_perfil" id="user"
                                                                placeholder="Perfil">
                                                        </div>
                                                        <div class="form-actions form-group">
                                                            <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20">Listo</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <script src="vendor/jquery-2.2.4.min.js"></script>
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
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<!-- end document-->
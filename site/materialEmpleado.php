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
    $messageInsert = '';
    if ($results && count($results) > 0) {
        $user = $results;
        if (!empty($_POST['material_e']) && !empty($_POST['quilataje_e']) && !empty($_POST['peso_e'])) {
            $validar_e = $conn->prepare('SELECT * FROM material WHERE name = :name and quilataje = :quilataje and id_Almacen = :id_Almacen');
            $validar_e->bindParam(':name', $_POST['material_e']);
            $validar_e->bindParam(':quilataje', $_POST['quilataje_e']);
            $id_Almacen = $user['id_Almacen'];
            $validar_e->bindParam(':id_Almacen', $id_Almacen);
            $validar_e->execute();
            $r_validar = $validar_e->fetch(PDO::FETCH_ASSOC);
            if ($r_validar && count($r_validar) > 0){
                $insert = $conn->prepare('UPDATE material SET peso = peso + :peso_e WHERE name = :name and quilataje = :quilataje and id_Almacen = :id_Almacen');
                $insert->bindParam(':peso_e', $_POST['peso_e']);
                $insert->bindParam(':name', $_POST['material_e']);
                $insert->bindParam(':quilataje', $_POST['quilataje_e']);
                $id_Almacen = $user['id_Almacen'];
                $insert->bindParam(':id_Almacen', $id_Almacen);
                $insert->execute();
                
                $insert = $conn->prepare('SELECT id, peso FROM material WHERE name = :name and quilataje = :quilataje and id_Almacen = :id_Almacen');
                $insert->bindParam(':name', $_POST['material_e']);
                $insert->bindParam(':quilataje', $_POST['quilataje_e']);
                $id_Almacen = $user['id_Almacen'];
                $insert->bindParam(':id_Almacen', $id_Almacen);
                $insert->execute();
                $id_empleado = $user['id']; 
                $getId = $insert->fetch(PDO::FETCH_ASSOC);
                $id_material = $getId['id'];
                $sql = "INSERT INTO registro (id_empleado, id_material, peso, fecha_actualizacion, estado, id_Almacen) VALUES (:id_empleado, :id_material, :peso, NOW(), 'ENTRADA', :id_Almacen)";
                $insert = $conn->prepare($sql);
                $insert->bindParam(':id_empleado', $id_empleado);
                $insert->bindParam(':id_material', $id_material);
                $insert->bindParam(':peso', $_POST['peso_e']);
                $insert->bindParam(':id_Almacen', $id_Almacen);
                $insert->execute();
            }
            else{
                $messageInsert = 'Los datos ingresados son incorrectos';
            }
        }
        else if(!empty($_POST['material_s']) && !empty($_POST['quilataje_s']) && !empty($_POST['peso_s'])){
            $validar_e = $conn->prepare('SELECT * FROM material WHERE name = :name and quilataje = :quilataje and id_Almacen = :id_Almacen');
            $validar_e->bindParam(':name', $_POST['material_s']);
            $validar_e->bindParam(':quilataje', $_POST['quilataje_s']);
            $id_Almacen = $user['id_Almacen'];
            $validar_e->bindParam(':id_Almacen', $id_Almacen);
            $validar_e->execute();
            $r_validar = $validar_e->fetch(PDO::FETCH_ASSOC);
            $converPost = $_POST['peso_s'];
            $convertPeso = $r_validar['peso'];
            $a = floatval($converPost);
            $b = floatval($convertPeso);
            if ($r_validar && count($r_validar) > 0 and $a <= $b ){
                $insert = $conn->prepare('UPDATE material SET peso = peso - :peso_s WHERE name = :name and quilataje = :quilataje and id_Almacen = :id_Almacen');
                $insert->bindParam(':peso_s', $_POST['peso_s']);
                $insert->bindParam(':name', $_POST['material_s']);
                $insert->bindParam(':quilataje', $_POST['quilataje_s']);
                $id_Almacen = $user['id_Almacen'];
                $insert->bindParam(':id_Almacen', $id_Almacen);
                $insert->execute();
                
                $insert = $conn->prepare('SELECT id, peso FROM material WHERE name = :name and quilataje = :quilataje and id_Almacen = :id_Almacen');
                $insert->bindParam(':name', $_POST['material_s']);
                $insert->bindParam(':quilataje', $_POST['quilataje_s']);
                $id_Almacen = $user['id_Almacen'];
                $insert->bindParam(':id_Almacen', $id_Almacen);
                $insert->execute();
                $id_empleado = $user['id']; 
                $getId = $insert->fetch(PDO::FETCH_ASSOC);
                $id_material = $getId['id'];
                $sql = "INSERT INTO registro (id_empleado, id_material, peso, fecha_actualizacion, estado, id_Almacen) VALUES (:id_empleado, :id_material, :peso, NOW(), 'SALIDA', :id_Almacen)";
                $insert = $conn->prepare($sql);
                $insert->bindParam(':id_empleado', $id_empleado);
                $insert->bindParam(':id_material', $id_material);
                $insert->bindParam(':peso', $_POST['peso_s']);
                $insert->bindParam(':id_Almacen', $id_Almacen);
                $insert->execute();
            }
            else{
                $messageInsert = 'Los datos ingresados son incorrectos';
            }
        }
        else{
            if(!empty($_POST['material_s'])  ){
                $messageInsert = 'Los datos ingresados son incorrectos';
            }
            elseif(!empty($_POST['material_e']) ){
                $messageInsert = 'Los datos ingresados son incorrectos';
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
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo.png" alt="CoolAdmin" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                        <li class="active has-sub">
                            <a href="homeEmpleado.php">
                                <i class="fas fa-tachometer-alt"></i>Overview</a>
                        </li>
                        <li>
                            <a href="materialEmpleado.php">
                                <i class="fas fa-table"></i>Materiales</a>
                        </li>
                        <li>
                            <a href="historialEmpleado.php">
                                <i class="fas fa-book"></i>Historial</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.php">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

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
                            <a href="homeEmpleado.php">
                                <i class="fas fa-tachometer-alt"></i>Overview</a>
                        </li>
                        <li class="active has-sub">
                            <a href="materialEmpleado.php">
                                <i class="fas fa-table"></i>Materiales</a>
                        </li>
    
                        <li>
                            <a href="historialEmpleado.php">
                                <i class="fas fa-book"></i>Historial</a>
                        </li>
                        
                            </ul>
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
                                            <img src="images/user.png" alt="User" />
                                        </div>
                                        <div class="content">
                                             <a class="js-acc-btn"><?= $user['name']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/user.png" alt="User" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <?php if(!empty($user)): ?>
                                                        <a href="#"><?= $user['name']; ?></a>
                                                        <?php endif; ?>
                                                    </h5>
                                                    <?php if(!empty($user)): ?>
                                                        <span class="email"><?= $user['username']; ?></span>
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
                        <?php if(!empty($messageInsert)): ?>
                            <div class="alert">
                              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                              <strong>ERROR</strong> Los datos son invalidos.
                            </div>
                        <?php endif; ?>
                        <div class="row m-t-30">
                                <div class="col-lg-6">
                                      <h2 class="title-1 m-b-25">Ingresa material</h2>
                                        <div class="card">
                                            <div class="card-header">Entrada</div>
                                            <div class="card-body card-block">
                                                <form action="materialEmpleado.php" method="post">
                                                    <div class="form-group">
                                                       <input class="au-input au-input--full" type="text" name="material_e" id="user" placeholder="Material"> 
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="au-input au-input--full" type="text" name="quilataje_e" id="user" placeholder="Quilataje">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="au-input au-input--full" type="text" name="peso_e" id="user" placeholder="Peso">
                                                    </div>
                                                    <div class="form-actions form-group">
                                                        <button type="submit" class="au-btn au-btn--block au-btn--blue m-b-20">Listo</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                            <h2 class="title-1 m-b-25">Retira material</h2>
                                            <div class="card">
                                                <div class="card-header">Salida</div>
                                                <div class="card-body card-block">
                                                <form action="materialEmpleado.php" method="post" >
                                                    <div class="form-group">
                                                        <input class="au-input au-input--full" type="text" name="material_s" id="user" placeholder="Material">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="au-input au-input--full" type="text" name="quilataje_s" id="user" placeholder="Quilataje">
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="au-input au-input--full" type="text" name="peso_s" id="user" placeholder="Peso">
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
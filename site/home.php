<?php
  session_start();
  require 'conexion.php';
  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, id_perfil, name, username, password FROM empleado WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    $messageUsuario = '';
    $messageUsername = '';
    if ($results && count($results) > 0) {
      $user = $results;
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
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="home.html">
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
                        <li class="active has-sub">
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
                                <i class="fas fa-book"></i>Historial</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.php">Login</a>
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
                                    <a href="grid.html">Grids</a>
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
                        <li class="active has-sub">
                            <a href="index.php">
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
                                    <i class="far fa-check-square"></i>Historial</a>
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
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
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
                                            <a class="js-acc-btn"><?= $user['name']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <img src="images/admin.png" alt="Admin" />
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
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="title-1 m-b-25">Materiales Recientes</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
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
                                        <tbody>
                                            <tr>
                                                <td>2018-09-29 05:57</td>
                                                <td>100398</td>
                                                <td>Jonathan Avila</td>
                                                <td class="text-right">313</td>
                                                <td class="text-right">Plata</td>
                                                <td class="text-right">1.25</td>
                                                <td class="text-right">12</td>
                                                <td class="text-right">Entrada</td>
                                            </tr>
                                            <tr>
                                                <td>2018-09-28 01:22</td>
                                                <td>100397</td>
                                                <td>Carlos Torres</td>
                                                <td class="text-right">925</td>
                                                <td class="text-right">Oro</td>
                                                <td class="text-right">2.00</td>
                                                <td class="text-right">14</td>
                                                <td class="text-right">Entrada</td>
                                            </tr>
                                            <tr>
                                                <td>2018-09-27 02:12</td>
                                                <td>100396</td>
                                                <td>Luisa Flores</td>
                                                <td class="text-right">115</td>
                                                <td class="text-right">Platino</td>
                                                <td class="text-right">1.50</td>
                                                <td class="text-right">10</td>
                                                <td class="text-right">Salida</td>
                                            </tr>
                                            <tr>
                                                <td>2018-09-26 23:06</td>
                                                <td>100395</td>
                                                <td>Pedro Paramo</td>
                                                <td class="text-right">738</td>
                                                <td class="text-right">Diamante</td>
                                                <td class="text-right">0.05</td>
                                                <td class="text-right">5</td>
                                                <td class="text-right">Entrada</td>
                                            </tr>
                                            <tr>
                                                <td>2018-09-25 19:03</td>
                                                <td>100393</td>
                                                <td>Juan Rulfo</td>
                                                <td class="text-right">738</td>
                                                <td class="text-right">Diamante</td>
                                                <td class="text-right">0.02</td>
                                                <td class="text-right">2</td>
                                                <td class="text-right">Entrada</td>
                                            </tr>
                                            <tr>
                                                <td>2018-09-29 05:57</td>
                                                <td>100392</td>
                                                <td>Humberto Suarez</td>
                                                <td class="text-right">925</td>
                                                <td class="text-right">Oro</td>
                                                <td class="text-right">2.25</td>
                                                <td class="text-right">24</td>
                                                <td class="text-right">Salida</td>
                                            </tr>
                                            <tr>
                                                <td>2018-09-24 19:10</td>
                                                <td>100391</td>
                                                <td>Carolina Moreno</td>
                                                <td class="text-right">313</td>
                                                <td class="text-right">Plata</td>
                                                <td class="text-right">0.78</td>
                                                <td class="text-right">12</td>
                                                <td class="text-right">Salida</td>
                                            </tr>
                                            <tr>
                                                <td>2018-09-22 00:43</td>
                                                <td>100393</td>
                                                <td>Anahi Ruvalcaba</td>
                                                <td class="text-right">313</td>
                                                <td class="text-right">Plata</td>
                                                <td class="text-right">0.98</td>
                                                <td class="text-right">12</td>
                                                <td class="text-right">Entrada</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h2 class="title-1 m-b-25">Nuevos Trabajadores</h2>
                                <div class="au-card au-card--bg-blue au-card-top-countries m-b-40">
                                    <div class="au-card-inner">
                                        <div class="table-responsive">
                                            <table class="table table-top-countries">
                                                <tbody>
                                                    <tr>
                                                        <td>Javier Lopez</td>
                                                        <td class="text-right">9083</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Miguel Hernandez</td>
                                                        <td class="text-right">9082</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hernan Costa</td>
                                                        <td class="text-right">9081</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kenny Gomez</td>
                                                        <td class="text-right">9080</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Laura Hurtado</td>
                                                        <td class="text-right">9079</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Karla Juarez</td>
                                                        <td class="text-right">9078</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Luis Lopez</td>
                                                        <td class="text-right">9077</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Humberto Sanchez</td>
                                                        <td class="text-right">9076</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
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
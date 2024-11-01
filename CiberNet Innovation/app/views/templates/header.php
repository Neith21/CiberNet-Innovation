<?php
session_start();
if ($_SESSION['userName'] == "") {
    header("Location: ../../../index.php");
    exit();
}

define('MAX_INACTIVITY', 300);

if (isset($_SESSION["LAST_ACTIVITY"]) && (time() - $_SESSION["LAST_ACTIVITY"] > MAX_INACTIVITY)) {
    session_unset();
    session_destroy();
    header("Location: ../../../index.php");
    exit();
}

$_SESSION["LAST_ACTIVITY"] = time();
?>
<?php ob_start() ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CiberNet Innovation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, ./public/l-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../../public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../public/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../public/dist/css/skins/_all-skins.min.css">

    <!-- Incluir CSS de DataTables y Buttons -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <script>
        const INACTIVITY_TIMEOUT = 5 * 60 * 1000;
        const ALERT_TIMEOUT = 4 * 60 * 1000;

        let inactivityTimer;
        let alertTimeout;

        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            clearTimeout(alertTimeout);

            alertTimeout = setTimeout(() => {
                const extendSession = confirm("Su sesión expirará en 1 minuto. ¿Desea extenderla?");
                if (extendSession) {
                    resetInactivityTimer();
                    extendUserSession();
                }
            }, ALERT_TIMEOUT);

            inactivityTimer = setTimeout(() => {
                window.location.href = './core/exit.php';
            }, INACTIVITY_TIMEOUT);
        }

        function extendUserSession() {
            fetch('./core/extend_session.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Sesión extendida.");
                    }
                })
                .catch(error => console.error("Error al extender la sesión:", error));
        }

        document.addEventListener('mousemove', resetInactivityTimer);
        document.addEventListener('keydown', resetInactivityTimer);

        resetInactivityTimer();
    </script>
    <style>
        .password-toggle {
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .password-toggle:hover {
            color: #0056b3;
        }

        .input-group {
            position: relative;
        }
    </style>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!--HEADER-->
        <header class="main-header">
            <!-- Logo -->
            <a href="../pages/index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>CN</b>I</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>CiberNet</b>Innovation</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $_SESSION["userName"] ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        <?php echo $_SESSION["userName"] . " - " . $_SESSION["RolID"]; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="../../../core/exit.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- =============================================== -->

        <!--MENU-->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li>
                        <a href="../pages/index.php">
                            <i class="fa fa-home"></i> <span>INICIO</span>
                        </a>
                    </li>
                    <li class="header">ADMINISTRACIÓN</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../pages/sale.php"><i class="fa fa-table"></i> Generar venta</a></li>
                            <li><a href="../pages/inventory.php"><i class="fa fa-table"></i> Inventario</a></li>
                            <li><a href="../pages/product.php"><i class="fa fa-table"></i> Productos </a></li>
                            <li><a href="../pages/category.php"><i class="fa fa-table"></i> Categorías </a></li>
                            <li><a href="../pages/supplier.php"><i class="fa fa-table"></i> Proveedores </a></li>
                            <?php if ($_SESSION["RolID"] == 1): ?>
                                <li>
                                    <a href="<?php echo $_SESSION["RolID"] != 1 ? '404' : '../sale/index.php'; ?>">
                                        <i class="fa fa-table"></i> Ventas
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION["RolID"] != 1 ? '404' : '../pages/user.php'; ?>">
                                        <i class="fa fa-table"></i> Usuarios
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $_SESSION["RolID"] != 1 ? '404' : '../pages/rol.php'; ?>">
                                        <i class="fa fa-table"></i> Roles
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="header">HERRAMIENTAS DE ANÁLISIS</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"></i> <span>Generación Reportes</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../pages/chart.php"><i class="fa fa-check"></i> Comprar ventas de productos </a></li>
                            <li><a href="../pages/chartSales.php"><i class="fa fa-check"></i> Productos mas Vendidos </a></li>
                            <li><a href="../pages/chartInventory.php"><i class="fa fa-check"></i> Movimientos de Inventario </a></li>
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
<?php
session_start();

if (!isset($_SESSION['userName']) || $_SESSION['userName'] == "") {
    header("Location: ./app/views/pages/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CiberNet Innovation</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, ./public/l-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="./public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="./public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./public/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="./public/dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
        <?php
        ob_start();
        include './app/views/templates/header.php';
        ?>

        <!-- =============================================== -->

        <!--MENU-->
        <?php include './app/views/templates/menu.php'; ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?php
            if (isset($_GET["pages"])) {
                if ($_GET["pages"] == "user") {
                    include "./app/views/pages/" . $_GET["pages"] . ".php";
                } 
                
                elseif ($_GET["pages"] == "rol") {
                    include "./app/views/pages/" . $_GET["pages"] . ".php";
                }
                
                elseif ($_GET["pages"] == "inventory") {
                    include "./app/views/pages/" . $_GET["pages"] . ".php";
                }

                if ($_GET["pages"] == "exit") {
                    include "./core/" . $_GET["pages"] . ".php";
                }
            }
            ?>
        </div>


        <!-- /.content-wrapper -->

        <!--FOOTER-->
        <?php include './app/views/templates/footer.php'; ?>

        <!-- jQuery 3 -->
        <script src="./public/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="./public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="./public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="./public/bower_components/fastclick/lib/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="./public/dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="./public/dist/js/demo.js"></script>

        <script>
            $(document).ready(function() {
                $('.sidebar-menu').tree()
            })
        </script>
</body>

</html>
<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Matrix lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Matrix admin lite design, Matrix admin lite dashboard bootstrap 5 dashboard template" />
    <meta name="description" content="Matrix Admin Lite Free Version is powerful and clean admin dashboard template, inpired from Bootstrap Framework" />
    <meta name="robots" content="noindex,nofollow" />
    <title>Inventario MATRIX</title>
    <link rel="icon" type="image/png" sizes="16x16" href="views/assets/images/favicon.png" />
    <link href="views/assets/libs/flot/css/float-chart.css" rel="stylesheet" />
    <link href="views/dist/css/style.min.css" rel="stylesheet" />

    <!-- plugins css -->
    <!-- bootstrap 3.3.7 -->
    <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
    <!-- theme style -->
    <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
    <!-- switch -->
    <link rel="stylesheet" href="views/dist/css/switch.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- DataTable -->
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
    <!-- checkbox -->
    <link rel="stylesheet" href="views/plugins/iCheck/all.css">
    <!-- Datarange picker -->
    <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- morris chart -->
    <link rel="stylesheet" href="views/bower_components/morris.js/morris.css">

    <!-- PLUGINS DE JAVASCRIPT -->
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script> <!-- jQuery -->
    <!-- bootstrap 3.3.7 -->
    <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- fastClick -->
    <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="views/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert 2 -->
    <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- InputMask -->
    <script src="views/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="views/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="views/plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- iCheck -->
    <script src="views/plugins/iCheck/icheck.min.js"></script>
    <!-- jQuery Number -->
    <script src="views/plugins/jqueryNumber/jquerynumber.min.js"></script>
    <!-- datarangepicker -->
    <script src="views/bower_components/moment/min/moment.min.js"></script>
    <script src="views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- morris.js -->
    <script src="views/bower_components/raphael/raphael.min.js"></script>
    <script src="views/bower_components/morris.js/morris.min.js"></script>
    <!-- chart js -->
    <script src="views/bower_components/Chart.js/Chart.js"></script>

    <!-- Incluir jQuery UI JS para el datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->

    <!-- ============================================================== -->
    <!-- Main wrapper -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- URL amigables -->
        <?php
        // Llamando al cabezote
        include "modulos/header.php";
        // Llamando al menú
        include "modulos/menu.php";
        if (isset($_GET["ruta"])) {
            if ($_GET["ruta"] == "inicio" || $_GET["ruta"] == "categoria" || $_GET["ruta"] == "usuarios" || $_GET["ruta"] == "marcas" || $_GET["ruta"] == "productos" || $_GET["ruta"] == "salir") {
                include "modulos/" . $_GET["ruta"] . ".php";
            } else {
                include "modulos/404.php";
            }
        } else {
            include "modulos/inicio.php";
        }
        // Llamando a footer
        include "modulos/footer.php";
        ?>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="views/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="views/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="views/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="views/assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
    <script src="views/dist/js/adminlte.min.js"></script>
    <script src="views/dist/js/waves.js"></script>
    <script src="views/dist/js/sidebarmenu.js"></script>
    <script src="views/dist/js/custom.min.js"></script>
    <script src="views/assets/libs/flot/excanvas.js"></script>
    <script src="views/assets/libs/flot/jquery.flot.js"></script>
    <script src="views/assets/libs/flot/jquery.flot.pie.js"></script>
    <script src="views/assets/libs/flot/jquery.flot.time.js"></script>
    <script src="views/assets/libs/flot/jquery.flot.stack.js"></script>
    <script src="views/assets/libs/flot/jquery.flot.crosshair.js"></script>
    <script src="views/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="views/dist/js/pages/chart/chart-page-init.js"></script>

    <!-- SweetAlert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    <!-- Tus propios scripts -->
    <script src="views/js/plantilla.js"></script>
    <script src="views/js/categoria.js"></script>
    <script src="views/js/marca.js"></script>
    <script src="views/js/producto.js"></script>
</body>

</html>

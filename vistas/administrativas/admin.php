    
        <link href="vistas/administrativas/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template admin-->
    <link href="vistas/administrativas/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vistas/administrativas/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            include_once "vistas/modulos/sidebar.php";
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                    include_once "vistas/modulos/topbar.php";

                    //Cargamos el contenido de acuerdo a la ruta
                    if(isset($_GET["route"])){

                        //creamos una lista de rutas permitidas

                        if(
                            $_GET["route"] == "dashboard" || 
                            $_GET["route"] == "usuarios" || 
                            $_GET["route"] == "categorias" || 
                            $_GET["route"] == "productos" || 
                            $_GET["route"] == "clientes" || 
                            $_GET["route"] == "ventas" || 
                            $_GET["route"] == "crear-venta" || 
                            $_GET["route"] == "reportes" ||
                            $_GET["route"] == "salir"

                        ){
                            include_once "vistas/paginas/".$_GET["route"]."/index.php";
                        }else{
                            include_once "vistas/paginas/404/index.php";
                        }

                    }else{
                        include_once "vistas/paginas/dashboard/index.php";
                    }
                    
                ?>

            </div>
            <!-- End of Main Content -->

            <?php
                include_once "vistas/modulos/footer.php";
            ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

                <?php
                    include_once "vistas/modulos/botones-flotantes.php";
                    include_once "vistas/modulos/modals.php";
                ?>



    <!-- SCRIPTS EXTERNOS -->


    <!-- Page level plugins -->
    <script src="vistas/administrativas/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vistas/administrativas/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Scripts propios -->
    <script src="vistas/recursos/js/activar-plugins.js"></script>
    <script src="vistas/recursos/js/datatable.js"></script>
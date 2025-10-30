<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UCC</title>
    <link rel="shortcut icon" href="public/identidad-corporativa/ucc.svg" type="image/x-icon">

    <!-- ESTILOS EXTERNOS -->
    <!-- Custom fonts for this template-->

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
   

    <!-- Bootstrap core JavaScript-->
    <script src="vistas/administrativas/vendor/jquery/jquery.min.js"></script>
    <script src="vistas/administrativas/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>




        <!-- Core theme JS-->
        <script src="vistas/publicas/js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    

</head>

<body id="page-top">

    <?php

        if(isset($_SESSION["admin"]) && $_SESSION["admin"] == "ok"){

            include_once  "vistas/administrativas/admin.php";
        
        }else{

            include_once "vistas/publicas/public.php";
        
        }
        
    ?>


    <!-- Core plugin JavaScript-->
    <script src="vistas/administrativas/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="vistas/administrativas/js/sb-admin-2.min.js"></script>

</body>

</html>
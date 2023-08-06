<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Instancia de bootstrap -->
        <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/bootstrap.min.css">
        
    </head>
    
    <body >
      <div class="b-example-divider"></div>
        <div class="container">
        
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="<?php echo constant('URL') ?>"><img src="public/img/logocia.jpg" class="d-flex align-items-center mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"></svg>
            </a>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
              <li><a href="<?php echo constant('URL') ?>registros" class="nav-link px-2 link-secondary">Registrar Usuario</a></li></h2></h2>
              <li><a href="<?php echo constant('URL') ?>usuarios" class="nav-link px-2 link-dark">Usuarios</a></li></h2>
              <li><a href="<?php echo constant('URL') ?>buscarsem" class="nav-link px-2 link-dark">Inventarios</a></li></h2>
              <li><a href="<?php echo constant('URL') ?>productos" class="nav-link px-2 link-dark">Productos</a></li></h2>
            </ul>
            
            <div class="col-md-3 text-end">
            <button type="button" class="btn btn-outline-primary"> <a href="">Login</a></button>
            </div>
          </div>

        </div>
      <div class="b-example-divider"></div>

      <script src="public/js/jquery.js"></script>
      <script src="public/js/bootstrap.min.css"></script>      
    </body>

</html>
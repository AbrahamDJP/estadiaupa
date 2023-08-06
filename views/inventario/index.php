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
        <link rel="stylesheet" href="">
    </head>
    <body>    
    
    <?php require 'views/header.php' ?>
        <h1>Inventario</h1>
        <!-- http://localhost/PDF/inventario.php -->
        <!-- <form action="<?php echo constant('URL') . 'inventarios'?>" method="post"> -->
        <form action="<?php echo constant('URL') . 'inventarios'?>" method="post">
            <select name="semana" id="">
            <?php                    
                include_once 'models/buscarsem.php';
                foreach($this->buscarsem as $row){
                    $inventario = new Buscarsemanas();
                    $inventario = $row;
            ?>
                <option value="<?php echo $inventario->sem ?>"><?php echo $inventario->sem ?></option>
            <?php } ?>
            </select>
            <input type="submit" value="Mostrar inventario">
        </form>
        <button type="submit"><a href="<?php echo constant('URL') . 'buscarsem/cargarexcel'?>">Registrar en inventario</a></button>
        <button type="submit"><a href="<?php echo constant('URL') . 'buscarsem/formsemana'?>">Registrar semana</a></button>
        <button type="submit"><a href="<?php echo constant('URL') . 'buscarsem/cargarsem'?>">Registrar Inventario Inicial</a></button>
        <button type="submit"><a href="<?php echo constant('URL') . 'buscarsem/reportesem'?>">Ver inventario semanal</a></button>
        <button type="submit"><a href="<?php echo constant('URL') . 'buscarsem/seminventariorep'?>">Registrar Inventario Reportado</a></button>
               
    <?php require 'views/footer.php' ?> 


    </body>
</html>
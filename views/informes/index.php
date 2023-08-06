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
    <form action="<?php echo constant('URL'); ?>informes" method="post">
        <table border="1">
            <thead>
                <tr>
                    <th>Cargar Semana</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <select name="semana"  id="">
                        <?php                    
                            include_once 'models/buscarsem.php';
                            foreach($this->buscarsem as $row){
                                $inventario = new Buscarsemanas();
                                $inventario = $row;
                        ?>
                            <option value="<?php echo $inventario->sem ?>"><?php echo $inventario->sem ?></option>
                        <?php } ?>
                    </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="submit" value="Ver inventario">
    </form>
    <?php require 'views/footer.php' ?>
    </body>
</html>
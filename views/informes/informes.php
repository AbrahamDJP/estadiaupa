<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes</title>
</head>
<body>
<div class="container">
    <div class="row">
    
    <?php $idsem = $_POST['semana'] ?>
    <?php require 'views/header.php' ?>
    <h2>Informe de la semana <?php echo $idsem ?></h2>
    <div class="col-4 offset-md-4">
        <a href="<?php echo constant('URL') . 'informes/pdf/' . $idsem; ?>" class="btn btn-info" tabindex="-1" role="button" >Descargar Reporte en PDF</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
            <th>Producto</th>
            <th>Stock Inicial</th>
            <th>Ventas</th>
            <th>Stock Final</th>
            <th>Stock Reportado</th>
            <th>Diferencia</th>
        </thead>
        <tbody>
        <?php
            $connect = new PDO("mysql:host=localhost;dbname=ociainventario", "root", "");

            $query = "SELECT idProducto, nombreProducto FROM tbl_producto";
            $statement = $connect->prepare($query);
            $statement->execute();
            $mostrar = $statement->fetchAll();
            foreach ($mostrar as $row => $datos) {
                $id = $datos["idProducto"];
                $product = $datos["nombreProducto"]; 
                echo "<tr>
                    <th>".$product."</th>
                    ";
                    $var = 0;
                    $query = "SELECT inventarioInicial, compras FROM tbl_stockinicial WHERE fkSemana = $idsem AND fkProducto = $id ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $most = $statement->fetchAll();
                    if(empty($most)){
                        //echo 'vasio';
                        echo "<th> 0 </th>";
                        $stockIn = 0;
                    }else{
                        foreach ($most as $row => $dts) {
                            $inInicial = $dts['inventarioInicial'];
                            $compras = $dts['compras'];
                            $stockIn = $inInicial+$compras;
                            echo "<th>".$stockIn."</th>";
                        }
                    }
                    //var_dump($most);
                                        
                    $query = "SELECT SUM(venta) FROM tbl_ventasdesemana AS tv INNER JOIN tbl_semana AS ts ON ts.idSemana = tv.fkSemana INNER JOIN tbl_producto AS tp ON tp.idProducto = tv.fkProducto WHERE ts.idSemana = $idsem AND tp.idProducto = $id ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $most = $statement->fetchAll();
                    if (empty($most)) {
                        echo "<th> 0 </th>";
                    }else{
                        foreach ($most as $row => $dts) {
                            //$compras = $dts['compras'];
                            //echo $dts['SUM(venta)'];
                            echo "<th>".$dts['SUM(venta)']."</th>";
                        }
                    }
                    $stockFin = $stockIn - $dts['SUM(venta)'];
                    echo "<th>".$stockFin."</th>";
                "</tr>";
            }            
        ?>
        </tbody>
    </table>
    </div>
</div>
    
    <?php require 'views/footer.php' ?>

</body>
</html>
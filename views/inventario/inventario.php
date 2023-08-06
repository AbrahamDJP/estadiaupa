<?php require 'views/header.php' ?>

<?php $idsem = $_POST['semana'] ?>

    <h1>Inventario Semana <?php echo $idsem ?></h1>
    <table border="1">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sabado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //echo $idsem;
            
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
                    
                    $query = "SELECT tv.venta FROM tbl_ventasdesemana AS tv INNER JOIN tbl_semana AS ts ON ts.idSemana=tv.fkSemana INNER JOIN tbl_producto AS tp ON tp.idProducto=tv.fkProducto INNER JOIN tbl_dias AS td ON td.idDia=tv.fkDia WHERE ts.idSemana= $idsem AND tp.idProducto = $id ";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $most = $statement->fetchAll();
                    foreach ($most as $row => $dts) {
                        echo "<th>".$dts['venta']."</th>";
                        $var++;
                    }
                    for ($i=$var; $i < 7 ; $i++) { 
                        echo "<th> 0 </th>";
                    }
                    
                    
                "</tr>";
            }            
        ?>
        </tbody>
    </table>

<?php require 'views/footer.php' ?>
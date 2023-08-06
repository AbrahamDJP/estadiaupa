<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require 'views/header.php' ?>

    <form action="<?php echo constant('URL'); ?>inventarios/inventarioreportado" method="post">
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
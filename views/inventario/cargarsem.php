<body>
<?php require 'views/header.php' ?>

    <form action="<?php echo constant('URL'); ?>buscarsem/invenInicial" method="post">
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
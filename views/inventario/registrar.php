<body>
<?php require 'views/header.php' ?>

    <h2>Registro de inventario</h2>
    <h3>Semana: <?php echo $this->semana; ?></h3>
    <h3>Semana: <?php echo $this->dia; ?></h3>
    <form action="<?php echo constant('URL'); ?>inventarios/registrar" method="post">
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidades Vendidas</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                include_once 'models/inventario.php';
                foreach($this->inventarios as $row){
                    $inventario = new Inventario();
                    $inventario = $row;
                ?>
                <tr>
                    <th><label for=""><?php  echo $inventario->nombreproducto ?></label></th>
                    <th><label for=""><?php  echo $inventario->precioproducto ?></label></th>
                    <th><input type="number" name="<?php  echo $inventario->idproducto ?>"></th>           
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <input type="submit" value="Registrar">
    </form>

<?php require 'views/footer.php' ?> 
</body>
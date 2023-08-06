<body>
<?php require 'views/header.php' ?>


<div class="container">
    <div class="row">
        <div class="col-6">
            <h2 class="text-center">Lista de productos</h2>
        </div>
        <div class="col-4">
            <button><a href="<?php echo constant('URL') . 'productos/registrarproducto' ?>"> Registrar nuevo Producto</a></button>
        </div>
    </div>



    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include_once 'models/producto.php';
                foreach($this->productos as $row){
                    $producto = new Producto();
                    $producto = $row;
            ?>
            <tr>
                <td><?php echo $producto->idProducto ?></td>
                <td><?php echo $producto->nombreProducto ?></td>
                <td><?php echo $producto->precioproducto ?></td>
                <td> <a href="<?php echo constant('URL') . 'productos/verproducto/' . $producto->idProducto; ?>">Editar</a>
                <a href="<?php echo constant('URL') . 'productos/eliminarproducto/' . $producto->idProducto; ?>">Eliminar</a></td> 
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
    

    <?php require 'views/footer.php' ?>
</body>
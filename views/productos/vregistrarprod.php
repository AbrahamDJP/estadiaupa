<body>
    <h2>Formulario de registro de productos</h2>
    <form action="<?php echo constant('URL'); ?>productos/insertar " method="post">
        <p><input type="text" name="producto"  placeholder="Nombre de producto" required size="50" ></p>
        <p><input type="number" name="precio"  placeholder="Precio del producto" required size="50" ></p>
        <input type="submit" value="Registrar Producto">
    </form>
</body>
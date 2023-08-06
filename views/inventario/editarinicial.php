<body>
<?php require 'views/header.php' ?>
<h2>Editar Inventario inicial</h2>
<div class="center"><?php //echo $this->mensaje;?> </div>

    <table class="table table-striped table-bordered">
        <thead>
            <th>Producto</th>
            <th>Inventario Inicial</th>
            <th>Compras Semanal</th>
        </thead>
        <tbody>
            <form action="<?php echo constant('URL'); ?>inventarios/updateStockInicial" method="post">
                <p><input type="hidden" name="id" required value="<?php echo $this->inventarioEdit->idVentaDeSemana; ?>"></p>
                <th><label><?php echo $this->inventarioEdit->nombreprod; ?></label></th>
                <th><p><input type="text" name="inventarioInicial" required size="50"
                value="<?php echo $this->inventarioEdit->inventarioInicial; ?>"></p></th>
                <th><p><input type="text" name="compras" required size="50"
                value="<?php echo $this->inventarioEdit->compras; ?>"></p></th>
            
        </tbody>
    </table>
    <input type="submit" value="Actualizar Inventario Inicial">
    </form>
        
        
        <script src="" async defer></script>
<?php require 'views/footer.php' ?> 
</body>
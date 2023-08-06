<body>
        <?php require 'views/header.php' ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h2>Editar datos del producto: <?php echo $this->producto->nombreproducto; ?></h2>

        <div class="center"><?php echo $this->mensaje;?> </div>

        <form action="<?php echo constant('URL'); ?>productos/actualizarproducto" method="post">
            <p><input type="hidden" name="id" required size="50"
            value="<?php echo $this->producto->idproducto; ?>"></p>
            <p><input type="text" name="producto" required size="50"
            value="<?php echo $this->producto->nombreproducto; ?>"></p>
            <p><input type="text" name="precio" required size="50"
            value="<?php echo $this->producto->precioproducto; ?>"></p>
            <input type="submit" value="Actualizar datos">
        </form>
        
        <script src="" async defer></script>
        <?php require 'views/footer.php' ?>
</body>
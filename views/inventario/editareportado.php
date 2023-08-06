<body>
        <?php require 'views/header.php' ?>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <h2>Editar Inventario Reportado: <?php echo $this->reportado->inventarioreportado; ?></h2>

        <div class="center"><?php echo $this->mensaje;?> </div>

        <form action="<?php echo constant('URL'); ?>inventarios/actualizareportado" method="post">
            <p><input type="hidden" name="idreportado" required size="50" value="<?php echo $this->reportado->inventarioreportado; ?>"></p>
            <p><?php echo $this->reportado->producto; ?></p>
            <p><input type="text" name="cantreportado" required size="50" value="<?php echo $this->reportado->cantidadreportado; ?>"></p>
            <input type="submit" value="Actualizar datos">
        </form>
        
        <script src="" async defer></script>
        <?php require 'views/footer.php' ?>
</body>
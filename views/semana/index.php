<body>
    
    <h2>Registrar nueva semana</h2>
    <form action="<?php echo constant('URL'); ?>buscarsem/registrarsemana" method="post">
    <p><input type="number" name="semana"  placeholder="Numero de semana" required size="50"></p>
    <input type="submit" value="Registrar semana">
    </form>
    <?php require 'views/footer.php' ?>
</body>
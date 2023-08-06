<body>

    <div class="container">

    </div>
    <h3 class="text-center">Editar datos del usuario: <?php echo $this->usuario->usuario; ?> con ID: <?php echo $this->usuario->id; ?>
    </h3>

    <div class="center"><?php echo $this->mensaje;?> </div>



    <form action="<?php echo constant('URL'); ?>usuarios/actualizarUsuario" method="post">
        <p><input type="text" name="id"  placeholder="Usuario" required size="50"
        value="<?php echo $this->usuario->id; ?>"></p>
        <p><input type="text" name="usuario"  placeholder="Usuario" required size="50"
        value="<?php echo $this->usuario->usuario; ?>"></p>
        <p><input type="password" name="contrasenia" placeholder="Contrasña" required size="50"
        value="<?php echo $this->usuario->contrasenia; ?>"></p>
        <p><input type="text" name="nombre" placeholder="Nombre" required size="50"
        value="<?php echo $this->usuario->nombre; ?>"></p>
        <p><input type="text" name="ap" placeholder="Apellido Paterno" required size="50"
        value="<?php echo $this->usuario->ap; ?>"></p>
        <p><input type="text" name="am" placeholder="Apellido Materno" required size="50"
        value="<?php echo $this->usuario->am; ?>"></p>
        <p><input type="text" name="correo" placeholder="Correo" required size="50"
        value="<?php echo $this->usuario->correo; ?>"></p>
        <p><input type="tel" name="telefono" placeholder="Telefono" required
        value="<?php echo $this->usuario->telefono; ?>"></p>
        <div class="radio" required>
            <h3>Tipo De Usuario:</h3>
                <input type="radio" name="tipo" required value="1"> Administrador
                <input type="radio" name="tipo" required value="2"> Normal
            
        </div>
        <input type="submit" value="Actualizar datos">
    </form>

    
</body>


<?php

class Registros extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //$this->view->render('registros/index');
        //echo "<p>Error al cargar el recurso</p>";
    }

    function render(){
        $mensajes = "";
        $this->view->mensaje = $mensajes;
        $this->view->render('registros/index');
    }

    function registrarUsuario(){

        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $nombre = $_POST['nombre'];
        $ap = $_POST['ap'];
        $am = $_POST['am'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $tipo = $_POST['tipo'];
        //echo "Alumno creado";
        $mensajes = "";

        if(
            $this->model->insert([
            'usuario' => $usuario, 'contrasenia' => $contrasenia, 'nombre' => $nombre, 'ap' => $ap, 'am' => $am,
            'correo' => $correo, 'telefono' => $telefono, 'tipo' => $tipo
            ])
        ){
            $mensajes = "Nuevo Usuario Creado";
        }else{
            $mensajes = "Usuario no registrado";
        }
        $this->view->mensaje = $mensajes;
        $this->render();
    }

}

?>
<?php

class Usuarios extends Controller {

    function __construct(){
        parent::__construct();
        $this->view->datos = [];
    }

    function render() {
        $usuarios = $this->model->get();
        //echo "hola render";
        $this->view->usuarios = $usuarios;
        $this->view->render('usuarios/index');
    }
    
    function verUsuario($param = null){
        //var_dump($param);
        $idUsuario = $param[0];
        //echo $idUsuario;
        $usuario = $this->model->getById($idUsuario);
        //var_dump($usuario);
        $this->view->usuario = $usuario;
        $this->view->mensaje = "";
        $this->view->render('usuarios/veditar');

    }

    function actualizarUsuario(){
        $id = $_POST['id'];
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['contrasenia'];
        $nombre = $_POST['nombre'];
        $ap = $_POST['ap'];
        $am = $_POST['am'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $tipo = $_POST['tipo'];
        //echo $id;
        //echo "Alumno creado";
        $mensaje = "";

        if(
            $this->model->update([
            'usuario' => $usuario, 'contrasenia' => $contrasenia, 'nombre' => $nombre, 'ap' => $ap, 'am' => $am,
            'correo' => $correo, 'telefono' => $telefono, 'tipo' => $tipo, 'id' => $id
            ])
        ){
            
            $this->view->$mensaje = "Usuario Editado Correctamente";
        }else{
            $this->view->$mensaje = "Usuario no Editado";
        }
        $usuarios = $this->model->get();
        $this->view->usuarios = $usuarios;
        $this->view->render('usuarios/index');
    }

    function eliminarUsuario($param = null){
        $idUsuario = $param[0];
        $mensaje = "";
        if(
            $this->model->deleteuser([
            'usuario' => $idUsuario
            ])
        ){
            
            $this->view->$mensaje = "Usuario Eliminado Correctamente";
        }else{
            $this->view->$mensaje = "Usuario no Eliminado";
        }
        $usuarios = $this->model->get();
        $this->view->usuarios = $usuarios;
        $this->view->render('usuarios/index');

    }

}

?>
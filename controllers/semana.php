<?php

class Semana extends Controller{
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

    function registrarsemana(){
        
        $semana = $_POST['semana'];
        //echo "Alumno creado";
        $mensaje = "";
        if(
            $this->model->insert([
            'semana' => $semana
            ])
        ){
            $mensaje = "Nuevo Usuario Creado";
        }else{
            $mensaje = "Usuario no registrado";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }
}

?>
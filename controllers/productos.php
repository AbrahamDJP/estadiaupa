<?php

class Productos extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->datos = [];
    }

    function render() {
        $productos = $this->model->get();
        //echo "hola render";
        $this->view->productos = $productos;
        $this->view->render('productos/index');
    }

    function verproducto($param = null){
        //echo "ver producto";
        $idproducto = $param[0];
        $producto = $this->model->getById($idproducto);
        $this->view->producto = $producto;
        $this->view->mensaje = "";
        $this->view->render('productos/veditar');
    }

    function actualizarproducto(){
        $id = $_POST['id'];
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $mensaje = "";
        if(
            $this->model->update(['nombre' => $producto, 'precio' => $precio, 'id' => $id])
        ){
            $this->view->$mensaje = "Producto Editado Correctamente";
        }else{
            $this->view->$mensaje = "Producto no Editado";
        }
        $productos = $this->model->get();
        //echo "hola render";
        $this->view->productos = $productos;
        $this->view->render('productos/index');

    }

    function eliminarproducto($param = null){
        $idprod = $param[0];
        $mensaje = "";
        if(
            $this->model->deleteprod([
            'idprod' => $idprod
            ])
        ){
            
            $this->view->$mensaje = "Usuario Eliminado Correctamente";
        }else{
            $this->view->$mensaje = "Usuario no Eliminado";
        }
        $productos = $this->model->get();
        $this->view->productos = $productos;
        $this->view->render('productos/index');
    
    }

    function registrarproducto(){
        $this->view->render('productos/vregistrarprod');
    }

    function insertar(){
        $producto = $_POST['producto'];
        $precio = $_POST['precio'];
        $mensaje = "";
        if(
            $this->model->insert(['producto' => $producto, 'precio' => $precio])
        ){
            $mensaje = "Nuevo Producto Creado";
        }else{
            $mensaje = "Producto no registrado";
        }
        $this->view->mensaje = $mensaje;
        $this->render();
    }
}

?>
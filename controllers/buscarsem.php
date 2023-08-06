<?php
//echo "hola buscar sem";
class buscarsem extends Controller{

    function __construct(){
        parent::__construct();
        $this->view->datos = [];
    }

    function render() {
        $buscarsem = $this->model->get();
        $this->view->buscarsem = $buscarsem;
        $this->view->render('inventario/index');
        //echo "hola render";
    }

    function cargarexcel(){
        $buscarsem = $this->model->get();
        $this->view->buscarsem = $buscarsem;
        $this->view->render('inventario/seleccionarsem');
    }

    function formsemana(){
        $this->view->render('semana/index');
        //$this->render();

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
    
    function invenInicial(){
        //echo 'hola cargar inventario inicial';
        $idsem = $_POST['semana'];
        echo $idsem;
        $cargarstockInicial = $this->model->getStockInicial($idsem);
        $this->view->cargarStockInicial = $cargarstockInicial;
        //var_dump($cargarstockInicial);

        $buscarProducto = $this->model->getProducto();
        $this->view->buscarProducto = $buscarProducto;
        $this->view->render('inventario/inveninicial');
    }

    function cargarsem(){
        echo "hola cargar sem";
        $buscarsem = $this->model->get();
        $this->view->buscarsem = $buscarsem;
        $this->view->render('inventario/cargarsem');
    }

    function reportesem(){
        echo "Reporte semanal";
        $buscarsem = $this->model->get();
        $this->view->buscarsem = $buscarsem;
        $this->view->render('informes/index');

    }

    function seminventariorep(){
        $buscarsem = $this->model->get();
        $this->view->buscarsem = $buscarsem;
        $this->view->render('inventario/buscarseminventariorep');
    }



}

?>
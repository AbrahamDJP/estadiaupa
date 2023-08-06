<?php

include_once 'models/buscarsem.php';

class Inventarios extends Controller{
    
    function __construct(){
        parent::__construct();
        $this->view->datos = [];
    }

    function render() {
        $id = $_POST['semana'];
        echo "La semana es: ".$id;
        $inventarios = $id;
        //var_dump ($inventarios);
        $this->view->inventarios = $id;
        $this->view->render('inventario/inventario');
        //var_dump($inventario);
        
    }

    function inicial(){
        $idsem = $_POST['semana'];
        $producto = $_POST['producto'];
        $cantInicial = $_POST['cantInicial'];
        $cantComptas = $_POST['cantCompra'];
        echo $idsem;
        echo $producto;
        echo $cantInicial;
        echo $cantComptas;

        if ($this->model->regInicial([
            'semana' => $idsem, 'producto'=> $producto, 'cantInicial'=> $cantInicial, 'cantCompra' => $cantComptas
            ])) 
        {
            $mensaje = "Inventario Inicial Registrado";
        }else{
            $mensaje = "No se pudo registrar el inventario";
        }
        $this->view->mensaje = $mensaje;
        $this->view->render('inventario/index');

    }

    function semana(){

        $sem = $_POST['semana'];
        $dia = $_POST['dia'];
        echo "La semana es:".$sem;
        echo "El dia es:".$dia;
        $inventarios = $this->model->productos($sem, $dia);
        //var_dump ($inventarios);
        $this->view->semana = $sem;
        $this->view->dia = $dia;
        $this->view->inventarios = $inventarios;
        $this->view->render('inventario/registrar');
    }

    function registrar(){
        $datosVentas =  
        $sem = $_POST['semana'];
        $dia = $_POST['dia'];
        $idsVentas = $this->model->datosVentas($sem, $dia);
        $this->view->render('inventario/index');
        
    }
    
    function import(){
        //echo 'Hola para importar';
        include 'vendor/autoload.php';
        $connect = new PDO("mysql:host=localhost;dbname=ociainventario", "root", "");

        if($_FILES["import_excel"]["name"] != ''){                
            $allowed_extension = array('xls', 'csv', 'xlsx');
            $file_array = explode(".", $_FILES["import_excel"]["name"]);
            $file_extension = end($file_array);

            if(in_array($file_extension, $allowed_extension)){
                $file_name = time() . '.' . $file_extension;
                move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
                $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

                $spreadsheet = $reader->load($file_name);

                unlink($file_name);

                $data = $spreadsheet->getActiveSheet()->toArray();

            foreach($data as $row){
                $insert_data = array(
                    ':id'  => $row[0],
                    ':producto'  => $row[1],
                    ':cantidad'  => $row[2]
                );

                $query = "
                INSERT INTO tbl_ventasdia 
                (folio_venta, descripcion_producto, cantidad) 
                VALUES (:id, :producto, :cantidad)
                ";

                $statement = $connect->prepare($query);
                $statement->execute($insert_data);
            }
            $message = '<div class="alert alert-success">Data Imported Successfully</div>';
            }else{
                $message = '<div class="alert alert-danger">Only .xls .csv or .xlsx file allowed</div>';
            }
        }else{
            $message = '<div class="alert alert-danger">Please Select File</div>';
        }
        echo $message;
    }

    function vistaStockInicial($param = null){
        //var_dump($param);
        $idinicial = $param[0];
        /*echo "<br>";
        echo $idinicial;*/
        $inventarioEdit = $this->model->getById($idinicial);
        //var_dump($inventarioEdit);
        $this->view->inventarioEdit = $inventarioEdit;
        //$this->view->mensaje = "";
        $this->view->render('inventario/editarinicial');
        
    }

    function updateStockInicial(){
        //echo "Editar stock inicial";
        $id = $_POST['id'];
        $inventarioInicial = $_POST['inventarioInicial'];
        $compras = $_POST['compras'];
        /*echo $id;
        echo $inventarioInicial;
        echo $compras;*/
        $mensaje = null;
        if(
            $this->model->update(['inventarioInicial' => $inventarioInicial, 'compras' => $compras, 'id' => $id])
        ){
            $this->view->$mensaje = "Producto Editado Correctamente";
        }else{
            $this->view->$mensaje = "Producto no Editado";
        }
        //$productos = $this->model->get();
        //echo "hola render";
        //$this->view->productos = $productos;
        $this->view->render('inventario/index');
    }

    function inventarioreportado(){
        $idsem = $_POST['semana'];
        //echo $idsem;
        $cargarinventariorep = $this->model->getInventarioReportado($idsem);
        $this->view->inventarioreportado = $cargarinventariorep;

        $buscarProducto = $this->model->getProducto();
        $this->view->buscarProducto = $buscarProducto;
        $this->view->render('inventario/inventarioreportado');
    }

    function registrarinventariorep(){
        $semana = $_POST['semana'];
        $producto = $_POST['producto'];
        $cantreportado = $_POST['cantreportado'];
        /*echo $producto;
        echo $cantreportado;
        echo $semana;*/
        $mensaje = "";
        if ($this->model->regInventarioRep([
            'semana' => $semana, 'producto'=> $producto, 'cantreportado'=> $cantreportado
            ])) 
        {
            $mensaje = "Inventario Reportado Registrado";
        }else{
            $mensaje = "No se pudo registrar el inventario";
        }
        $this->view->mensaje = $mensaje;
        $this->view->render('inventario/index');
    }

    function editareportado($param = null){
        $idreportado = $param[0];
        
        $reportado = $this->model->getreportado($idreportado);
        $this->view->reportado = $reportado;
        $this->view->mensaje = "";
        $this->view->render('inventario/editareportado');

    }

    function actualizareportado(){
        $idreportado = $_POST['idreportado'];
        $cantreportado = $_POST['cantreportado'];
        $mensaje = "";
        if(
            $this->model->updatereportado([
            'idreportado' => $idreportado, 'cantreportado' => $cantreportado
            ])
        ){
            
            $this->view->$mensaje = "Registro Editado Correctamente";
        }else{
            $this->view->$mensaje = "Registro no Editado";
        }
        $this->view->render('inventario/index');
    }

    function eliminareportado($param = null){
        $idreportado = $param[0];
        $mensaje = "";
        if(
            $this->model->deletereportado([
            'idreportado' => $idreportado
            ])
        ){
            
            $this->view->$mensaje = "Registro Eliminado Correctamente";
        }else{
            $this->view->$mensaje = "Registro no Eliminado";
        }
        $this->view->render('inventario/index');

    }




}

?>
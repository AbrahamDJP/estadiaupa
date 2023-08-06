<?php

include 'plantilla.php';
require_once 'models/buscarsem.php';
require_once 'models/producto.php';


class Informes extends Controller{

    function __construct(){
        parent::__construct();
        //$this->view->render('informes/index');
        //echo "hola informes";
    }

    function render(){
        $semana = $_POST['semana'];
        echo $semana;
        $this->view->render('informes/informes');
        
    }

    function pdf($param = null){
        $idsem = $param[0];
        echo $idsem;    
        require 'conexion.php';
        $query = "SELECT idProducto, nombreProducto FROM tbl_producto";
        //$query = "SELECT inventarioInicial, compras FROM tbl_stockinicial WHERE fkSemana = $idsem";
        $resultado = $mysqli->query($query);
        
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        
        $pdf->SetFillColor(232,232,232);
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(80,6,'Producto',1,0,'C',1);
        $pdf->Cell(30,6,'Inventario Inicial',1,0,'C',1);
        $pdf->Cell(30,6,'Ventas',1,0,'C',1);
        $pdf->Cell(30,6,'Inventario Final',1,1,'C',1);

        $pdf->SetFont('Arial','',6);
	
        while($row = $resultado->fetch_assoc()){
            $idprod = $row['idProducto'];

            $pdf->Cell(80,6,$row['nombreProducto'],1,0,'C');
            
            $que = "SELECT inventarioInicial, compras FROM tbl_stockinicial WHERE fkSemana = $idsem AND fkProducto = $idprod ";
            $statement = $mysqli->query($que);
            if(empty($statement->fetch_assoc())){
                echo 'vacio';
                $pdf->Cell(30,6,'0',1,0,'C');
                $inicial = 0;
            }
            else{
                echo 'lleno';
                $statement = $mysqli->query($que);
                while($raw = $statement->fetch_assoc()){
                    $inInicial = $raw['inventarioInicial'];
                    $compras = $raw['compras'];
                    $inicial = $inInicial + $compras;
                    $pdf->Cell(30,6,$inicial,1,0,'C');
                
                }
            }
            $queryVentas = "SELECT SUM(venta) FROM tbl_ventasdesemana AS tv INNER JOIN tbl_semana AS ts ON ts.idSemana = tv.fkSemana INNER JOIN tbl_producto AS tp ON tp.idProducto = tv.fkProducto WHERE ts.idSemana = $idsem AND tp.idProducto = $idprod ";
            $st = $mysqli->query($queryVentas);
            if(empty($st->fetch_assoc())){
                echo 'vacio';
                $pdf->Cell(30,6,'0',1,0,'C');
            }else{
                $st = $mysqli->query($queryVentas);
                while($rowVentas = $st->fetch_assoc()){
                    $ventas = $rowVentas['SUM(venta)'];
                    $pdf->Cell(30,6,$ventas,1,0,'C');
                
                }
            }
            $stockFin = $inicial - $ventas;
            /*$pdf->Cell(5,6,$inicial,1,0,'C');
            $pdf->Cell(5,6,$ventas,1,1,'C');*/
            $pdf->Cell(30,6,$stockFin,1,1,'C');
            
        }
        ob_end_clean();
	    $pdf->Output();
    }

    

}

?>
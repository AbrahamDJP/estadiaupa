<?php

include_once 'models/inventario.php';
include_once 'models/producto.php';

class inventariosModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function get($idSemana){
        echo "ver inventario";
        $item = new Inventario();
        $idsproductos = $this->obnumproductos();
        //echo $idsproductos;
        $items = [];

        try{
/*
            for ($i=1; $i<=$idsproductos; $i++) {
                //echo $i;
                for ($j=1; $j <= 7 ; $j++) { 
                  //  echo $j;
*/                    $query = $this->db->connect()->prepare("SELECT tv.venta 
                    FROM tbl_ventasdesemana AS tv INNER JOIN tbl_semana AS ts ON ts.idSemana=tv.fkSemana 
                    INNER JOIN tbl_producto AS tp ON tp.idProducto=tv.fkProducto 
                    INNER JOIN tbl_dias AS td ON td.idDia=tv.fkDia 
                    WHERE ts.idSemana=1 AND tp.idProducto= 1 AND td.idDia= 1");

                    while ($row = $query->fetch()) {
                        $ven = $item->venta = $row['tv.venta'];
                        var_dump($row['venta']);
                        echo $ven;
                        array_push($items, $item);
                    }
                    return $items;

                    //echo $ven;
                   /*
                  
                }
                echo '<br>';

            }*/

        }catch (PDOException $e){
            return [];
        }
        //var_dump($items);
    }

    public function getById($id){
        
        $query = $this->db->connect()->prepare(
            "SELECT ts.idStockInicial, ts.fkSemana, ts.fkProducto, ts.inventarioInicial, ts.compras, tp.nombreProducto FROM tbl_stockinicial AS ts INNER JOIN tbl_producto AS tp ON tp.idProducto = ts.fkProducto WHERE idStockInicial = :id");
        //echo $id;

        try{
            $query->execute(['id' => $id]);
            while($row = $query->fetch()){
                $item = new Inventario;
                $item->idVentaDeSemana = $row['idStockInicial'];
                $item->semana = $row['fkSemana'];
                $item->producto = $row['fkProducto'];
                $item->inventarioInicial = $row['inventarioInicial'];
                $item->compras = $row['compras'];
                $item->nombreprod = $row['nombreProducto'];
            }
            //var_dump($item);
            return $item;

        }catch(PDOException $e){
            return null;
        }
    }

    public function update($item){
        echo 'Editar stock inicial';
        //echo $item['lunes'];
        $query = $this->db->connect()->prepare("UPDATE tbl_stockinicial SET 
        inventarioInicial = :inventarioInicial,
        compras = :compras
        WHERE idStockInicial = :id");
        try{
            $query->execute([
                'inventarioInicial' => $item['inventarioInicial'],
                'compras' => $item['compras'],
                'id' => $item['id']
            ]);
            //return $item['id'];
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function productos($semana, $dia){
        $items = [];
        try{       
            $query = $this->db->connect()->query("SELECT * FROM tbl_producto");            
            while($row = $query->fetch()){
                $item = new Producto();
                $item->idproducto = $row['idProducto'];
                $item->nombreproducto = $row['nombreProducto'];
                $item->precioproducto = $row['precioProducto'];
                $item->dia = [$semana];
                $item->dia = [$dia];
                array_push($items, $item);
            }
            //var_dump($item);
            return $items;
        }catch (PDOException $e){
            return [];
        }
    }

    public function datosVentas($sem, $dia){
        //echo $dia;
        //echo $sem;
        $item = new Inventario();
        $prod = new Producto();
        $numeroProd = $this->obnumproductos();
        for ($i=1; $i <=$numeroProd ; $i++) { 
            $producto = $this->obtenerProducto($i);
            if(!empty($producto)){
                $cantVend = $this->obtenerVentasProductos($producto);
                $item->sem = $sem;
                $item->dia = $dia;
                $item->producto = $producto;
                $item->totalVentas = $cantVend;
                $idsventa = $this->obtenerIDs($item);
                /*echo $idsventa->semana;
                echo $idsventa->dia;
                echo $idsventa->producto;
                */
                $this->insertarVentas($idsventa,$item);
                
            }else{
                echo "vacio";
            }
            echo '---';
        }
        $this->vaciarTabla();
    }

    public function vaciarTabla(){
        $query = $this->db->connect()->prepare("TRUNCATE TABLE tbl_ventasdia");
        $query->execute();
    }

    public function obtenerIDs($datos){
        $sema = $datos->sem;
        $diasem = $datos->dia;
        $nomprod = $datos->producto;
        $ventasProd = $datos->totalVentas;
        $query = $this->db->connect()->prepare("SELECT ts.idSemana, td.idDia, tp.idProducto 
        FROM tbl_semana AS ts INNER JOIN tbl_dias AS td INNER JOIN tbl_producto AS tp
        WHERE ts.semana = $sema AND td.dia = '$diasem' AND tp.nombreProducto = '$nomprod'");
        try {
            $query->execute();
            while($row = $query->fetch()){  
                $idventa = new Inventario();
                $idventa->semana = $row['idSemana'];
                $idventa->dia = $row['idDia'];
                $idventa->producto = $row['idProducto'];
                return $idventa;
                
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function insertarVentas($idsventa, $item){
        /*echo $idsventa->semana;
        echo $idsventa->dia;
        echo $idsventa->producto;
        echo $item->totalVentas;*/
        echo $idsventa->semana;
        echo $idsventa->producto;
        echo $item->dia;
        echo $item->totalVentas;

        $query = $this->db->connect()->prepare("INSERT INTO tbl_ventasdesemana (fkSemana, fkProducto, fkDia, venta) 
        VALUES ($idsventa->semana, $idsventa->producto, $idsventa->dia, $item->totalVentas)");
        $query->execute();
    }

    public function obtenerProducto($numeroProd){
        $query = $this->db->connect()->prepare("SELECT nombreProducto FROM tbl_producto WHERE idProducto = $numeroProd");
        try{
            $query->execute();
            while($row = $query->fetch()){  
                $item = new Producto();           
                $item->nombreproducto = $row['nombreProducto'];
            }
            if(isset($item)){
                $producto = $item->nombreproducto;
                return $producto;
            }else{
                $producto = "";
            }
        }catch(PDOException $e){
            return null;
        }
    
    }

    public function obnumproductos(){
        $query = $this->db->connect()->prepare("SELECT max(idProducto) FROM tbl_producto");
        try{
            $query->execute();
            while($row = $query->fetch()){
                $item = new Producto();
                $item->idProducto = $row['max(idProducto)'];
            }
            $num = $item->idProducto;
            //var_dump($num);
            //echo $num;
            return $num;
        }catch(PDOException $e){
            return null;
        }
    }
    
    public function obtenerVentasProductos($producto){
        //echo '-'.$producto.'-';
        $query = $this->db->connect()->prepare("SELECT COUNT(descripcion_producto) FROM tbl_ventasdia where descripcion_producto = '$producto'");
        try{
            $query->execute();
            while($row = $query->fetch()){
                $item = new Producto();
                $item->cantVendida = $row['COUNT(descripcion_producto)'];
            }
            $vendidos = $item->cantVendida;
            //echo '-'.$vendidos.'-';
            return $vendidos;
            $item->cantVendida = "";
        }catch(PDOException $e){
            return null;
        }
    
    }

    public function regInicial($datos){
        echo '<br>';
        echo 'Metodo del modelo';
        $idsem = $datos['semana'];
        $producto = $datos['producto'];
        $cantInicial = $datos['cantInicial'];
        $cantComptas = $datos['cantCompra'];
        echo $idsem;
        echo $producto;
        echo $cantInicial;
        echo $cantComptas;
        
        try {
            $query = $this->db->connect()->prepare(
                'INSERT INTO tbl_stockinicial (fkSemana, fkProducto, inventarioInicial, compras)
                VALUES (:fkSemana, :fkProducto, :inventarioInicial, :compras)'
            );
            $query->execute([
                'fkSemana' => $datos['semana'],
                'fkProducto' => $datos['producto'],
                'inventarioInicial' => $datos['cantInicial'],
                'compras' => $datos['cantCompra']
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }

    }

    public function getInventarioReportado($idsem){
        $items = [];
        try{

            $query = $this->db->connect()->query("SELECT tir.idInventarioReportado, tir.fkSemana, tp.nombreProducto, tir.cantidadReportado FROM tbl_inventarioreportado as tir INNER JOIN tbl_producto AS tp ON tp.idProducto = tir.fkProducto WHERE tir.fkSemana = $idsem ");
            
            while($row = $query->fetch()){
                $item = new Producto();
                $item->idproducto = $row['idInventarioReportado'];
                $item->semana = $row['fkSemana'];
                $item->nombreProducto = $row['nombreProducto'];
                $item->inventarioreportado = $row['cantidadReportado'];
                array_push($items, $item);
            }
            //var_dump($items);
            return $items;
            

        }catch (PDOException $e){
            return [];
        }
    }

    public function getProducto(){
        $items = [];
        try{

            $query = $this->db->connect()->query("SELECT * FROM tbl_producto");
            
            while($row = $query->fetch()){
                $item = new Producto();
                $item->idProducto = $row['idProducto'];
                $item->nombreProducto = $row['nombreProducto'];
                $item->precioproducto = $row['precioProducto'];
                array_push($items, $item);
            }

            return $items;

        }catch (PDOException $e){
            return [];
        }
    }

    public function regInventarioRep($datos){
        /*$idsem = $datos['semana'];
        $producto = $datos['producto'];
        $cantInicial = $datos['cantInicial'];*/
        try {
            $query = $this->db->connect()->prepare(
                'INSERT INTO tbl_inventarioreportado (fkSemana, fkProducto, cantidadReportado)
                VALUES (:fkSemana, :fkProducto, :cantidadReportado)'
            );
            $query->execute([
                'fkSemana' => $datos['semana'],
                'fkProducto' => $datos['producto'],
                'cantidadReportado' => $datos['cantreportado']
            ]);
            return true;
        } catch (\Throwable $th) {
            throw $th;
            return false;
        }

    }

    public function getreportado($idreportado){
        $item = new Inventario;
        $query = $this->db->connect()->prepare(
            "SELECT tir.idInventarioReportado, tir.fkSemana, tp.nombreProducto, tir.cantidadReportado 
            FROM tbl_inventarioreportado as tir INNER JOIN tbl_producto AS tp ON tp.idProducto = tir.fkProducto 
            WHERE tir.idInventarioReportado = :idreportado ");
        try {
            $query->execute(['idreportado' => $idreportado]);
            while($row = $query->fetch()){
                $item->inventarioreportado = $row['idInventarioReportado'];
                $item->semana = $row['fkSemana'];
                $item->producto = $row['nombreProducto'];
                $item->cantidadreportado = $row['cantidadReportado'];
            }
            //var_dump($item);
            return $item;

        } catch (\Throwable $th) {
            throw $th;
            return null;
        }

    }

    public function updatereportado($item){
        /*echo $item['idreportado'];
        echo $item['cantreportado'];
        echo "datos editar reportado";*/
        $query = $this->db->connect()->prepare("UPDATE tbl_inventarioreportado SET 
        cantidadReportado = :cantreportado
        WHERE idInventarioReportado = :idreportado ");
        try{
            $query->execute([
                'cantreportado' => $item['cantreportado'],
                'idreportado' => $item['idreportado']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

    public function deletereportado($item){
        $query = $this->db->connect()->prepare("DELETE FROM tbl_inventarioreportado WHERE idInventarioReportado = :idreportado");
        try{
            $query->execute(['idreportado' => $item['idreportado']]);
            return true;
        }catch(PDOException $e){
            return false;
        }

    }  



}


?>
<?php

require_once 'models/buscarsem.php';
require_once 'models/producto.php';

class buscarsemModel extends Model {

    public function __construct() {
        parent::__construct();
        //echo "hola buscarsemModel";
    }

    public function get(){
        $items = [];
        try{

            $query = $this->db->connect()->query("SELECT * FROM tbl_semana");
            
            while($row = $query->fetch()){
                $item = new Buscarsemanas();
                $item->idsem = $row['idSemana'];
                $item->sem = $row['semana'];
                
                array_push($items, $item);

            }

            return $items;

        }catch (PDOException $e){
            return [];
        }
    }

    public function dia(){
        $items = [];
        try{

            $query = $this->db->connect()->query("SELECT * FROM tbl_semana");
            
            while($row = $query->fetch()){
                $item = new Buscarsemanas();
                $item->idsem = $row['idSemana'];
                $item->sem = $row['semana'];
                
                array_push($items, $item);

            }

            return $items;

        }catch (PDOException $e){
            return [];
        }
    }

    public function insert($datos){

        try {
            $query = $this->db->connect()->prepare(
                'INSERT INTO tbl_semana (semana)
                VALUES (:semana)'
            );
            $query->execute([
                'semana' => $datos['semana']
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
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

    public function getStockInicial($idsem){
        $items = [];
        try{

            $query = $this->db->connect()->query("SELECT idStockInicial, fkSemana, tp.nombreProducto, inventarioInicial, compras FROM tbl_stockinicial AS si INNER JOIN tbl_semana as ts ON ts.idSemana = si.fkSemana INNER JOIN tbl_producto AS tp ON tp.idProducto = si.fkProducto WHERE ts.semana = $idsem ");
            
            while($row = $query->fetch()){
                $item = new Producto();
                $item->idproducto = $row['idStockInicial'];
                $item->semana = $row['fkSemana'];
                $item->nombreProducto = $row['nombreProducto'];
                $item->inventarioInicial = $row['inventarioInicial'];
                $item->compras = $row['compras'];
                array_push($items, $item);
            }
            //var_dump($items);
            return $items;
            

        }catch (PDOException $e){
            return [];
        }
    }



}

?>
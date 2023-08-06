<?php

include_once 'models/producto.php';

class productosModel extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function get(){
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

    public function getById($id){
        $item = new Producto;
        //var_dump($item);
        //echo "El id es: " . $id;
        $query = $this->db->connect()->prepare("SELECT * FROM tbl_producto WHERE idProducto = :idProducto");
        //var_dump($query);
        try{
            $query->execute(['idProducto' => $id]);
            while($row = $query->fetch()){
                $item->idproducto = $row['idProducto'];
                $item->nombreproducto = $row['nombreProducto'];
                $item->precioproducto = $row['precioProducto'];
            }
            //var_dump($item);
            return $item;

        }catch(PDOException $e){
            return null;

        }
    }

    public function update($item){

        $query = $this->db->connect()->prepare("UPDATE tbl_producto SET 
        nombreProducto = :nombre, 
        precioProducto = :precio
        WHERE idProducto = :id");
        try{
            $query->execute([
                'nombre' => $item['nombre'],
                'precio' => $item['precio'],
                'id' => $item['id']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        

    }

    public function insert($datos){
        try {
            $query = $this->db->connect()->prepare(
                'INSERT INTO tbl_producto (nombreProducto, precioProducto)
                VALUES (:nombre, :precio)'
            );
            $query->execute([
                'nombre' => $datos['producto'],
                'precio' => $datos['precio'],
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
    }

    public function deleteprod($item){
        $query = $this->db->connect()->prepare("DELETE FROM tbl_producto WHERE idProducto = :id");
        try{
            $query->execute(['id' => $item['idprod']]);
            return true;
        }catch(PDOException $e){
            return false;
        }    
    }

}

?>
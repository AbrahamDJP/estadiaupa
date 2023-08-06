<?php

include_once 'models/usuario.php';

class usuariosModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function get(){
        $items = [];
        try{

            $query = $this->db->connect()->query("SELECT * FROM tbl_usuario");
            
            while($row = $query->fetch()){
                $item = new Usuario();
                $item->id = $row['idUsuario'];
                $item->usuario = $row['usuario'];
                $item->contrasenia = $row['contraseña'];
                $item->nombre = $row['nombreUsuario'];
                $item->ap = $row['ap_usuario'];
                $item->am = $row['am_usuario'];
                $item->correo = $row['correo'];
                $item->telefono = $row['telefono'];
                $item->tipo = $row['fkTipoUsuario'];

                array_push($items, $item);

            }

            return $items;

        }catch (PDOException $e){
            return [];
        }
    }

    public function getById($id){
        $item = new Usuario;
        //var_dump($item);
        //echo "El id es: " . $id;
        $query = $this->db->connect()->prepare("SELECT * FROM tbl_usuario WHERE idUsuario = :idUsuario");
        //var_dump($query);
        try{
            $query->execute(['idUsuario' => $id]);
            while($row = $query->fetch()){
                $item->id = $row['idUsuario'];
                $item->usuario = $row['usuario'];
                $item->contrasenia = $row['contraseña'];
                $item->nombre = $row['nombreUsuario'];
                $item->ap = $row['ap_usuario'];
                $item->am = $row['am_usuario'];
                $item->correo = $row['correo'];
                $item->telefono = $row['telefono'];
                $item->tipo = $row['fkTipoUsuario'];
            }
            //var_dump($item);
            return $item;

        }catch(PDOException $e){
            return null;

        }
    }

    public function update($item){

        $query = $this->db->connect()->prepare("UPDATE tbl_usuario SET 
        usuario = :usuario, 
        contraseña = :contrasenia, 
        nombreUsuario = :nombre, 
        ap_usuario = :ap, 
        am_usuario = :am, 
        correo = :correo,
        telefono = :telefono, 
        fkTipoUsuario = :tipo 
        WHERE idUsuario = :id");
        try{
            $query->execute([
                'usuario' => $item['usuario'],
                'contrasenia' => $item['usuario'],
                'nombre' => $item['nombre'],
                'ap' => $item['ap'],
                'am' => $item['am'],
                'correo' => $item['correo'],
                'telefono' => $item['telefono'],
                'tipo' => $item['tipo'],
                'id' => $item['id']
            ]);
            return true;
        }catch(PDOException $e){
            return false;
        }
        
    }

    function deleteUser($item){
        $query = $this->db->connect()->prepare("DELETE FROM tbl_usuario WHERE idUsuario = :id");
        try{
            $query->execute(['id' => $item['usuario']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }

}

?>
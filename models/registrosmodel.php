<?php

class registrosModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    public function insert($datos){

        try {
            $query = $this->db->connect()->prepare(
                'INSERT INTO tbl_usuario (usuario, contraseña, nombreUsuario, ap_usuario, am_usuario,correo, telefono, fkTipoUsuario)
                VALUES (:usuario, :contrasenia, :nombre, :ap, :am, :correo, :telefono, :tipo)'
            );
            $query->execute([
                'usuario' => $datos['usuario'],
                'contrasenia' => $datos['contrasenia'],
                'nombre' => $datos['nombre'],
                'ap' => $datos['ap'],
                'am' => $datos['am'],
                'correo' => $datos['correo'],
                'telefono' => $datos['telefono'],
                'tipo' => $datos['tipo']
            ]);
            return true;
        }catch(PDOException $e){
            echo $e;
            return false;
        }
        /*echo $datos['usuario'];
        echo $datos['contrasenia'];
        echo $datos['nombre'];
        echo $datos['ap'];
        echo $datos['am'];
        echo $datos['correo'];
        echo $datos['telefono'];
        echo $datos['tipo'];
*/
        echo "Insertar datos";  
    }

}

?>
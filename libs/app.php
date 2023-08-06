<?php

require_once 'controllers/informes.php';
require_once 'controllers/registros.php';
require_once 'controllers/errores.php';

class App{    

    function __construct(){
        //echo "<p>Nueva app</p>";
        $url = isset($_GET['url']) ? $_GET['url']: null;
        $url = rtrim($url,'/');
        $url = explode('/', $url);
        //var_dump($url);

        /*session_start();
        if(!isset($_SESSION['rol'])){
            $archivoController = 'controllers/login.php';
            require_once $archivoController;
            $controller = new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }*/

        if(empty($url[0])){
            $archivoController = 'controllers/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('main');
            $controller->render();
            return false;
        }

        $archivoController = 'controllers/' . $url[0] . '.php';
        //echo $archivoController;

        if(file_exists($archivoController)){

            require_once $archivoController;

            //INICIALIZAR CONTROLADOR Y CARGAR MODELO
            $controller = new $url[0];
            $controller->loadModel($url[0]);
            $nparam = sizeof($url);
            
            if($nparam > 1){

                if($nparam > 2){

                    $param = [];
                    for($i=2; $i<$nparam; $i++){
                        array_push($param, $url[$i]);
                    }
                    $controller->{$url[1]}($param);
                    
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }
        }else{            
            $controller = new Errores();
        }        
    }
}
?>
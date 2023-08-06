<?php

class Controller{
    function __construct(){
        //echo "<p>Controlador base</p>";
        $this->view = new View();
    }

    function loadModel($model){
        $url = 'models/'.$model.'model.php';
        //echo $url;

        if(file_exists($url)){
            require $url;

            $modelName = $model.'Model';
            //echo $modelName;
            $this->model = new $modelName();
            //echo "hola desde el if del load";
        }
        /*else{
            //echo "No existe";
        }*/
        //echo "hola loadmodel";
    }


}

?>
<?php

namespace Todos;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new \Todos\Request();

        \Todos\Router::parse($this->request->url, $this->request);

        $controller = $this->loadController();

        if($controller != NULL){
            call_user_func_array([$controller, $this->request->action], $this->request->params);
        }

    }

    public function loadController()
    {
        $name = "Todos\Controllers\\" . $this->request->controller . "Controller";
        if(class_exists($name)){
            $controller = new $name();
        }else{
            $controller = NULL; 
            echo $name." doesn't exist.";
        }
        return $controller;
        
    }

}
?>
<?php
    namespace Todos;
    class Router
    {

        static public function parse($url, $request)
        {
            $url = trim($url);
            $explode_url = explode('/', $url);
            $explode_url = array_slice($explode_url, 2);

            if (count($explode_url) == 1 && $explode_url[0] == '') {
                $request->controller = 'home';
                $request->action = 'index';
                $request->params = array();
            } else if (count($explode_url) == 1) {
                $request->controller = $explode_url[0];
                $request->action = 'index';
                $request->params = array();
            } else if (count($explode_url) == 2) {
                $request->controller = $explode_url[0];
                $request->action = $explode_url[1];
                $request->params = array();
            } else if (count($explode_url) == 3) {
                $request->controller = $explode_url[0];
                $request->action = $explode_url[1];
                $request->params = array_slice($explode_url, 2);
            }
            else{
                $request->controller = $explode_url[0];
                $request->action = $explode_url[1];
                $request->params = array_slice($explode_url, 2);
            }


        }
    }
?>
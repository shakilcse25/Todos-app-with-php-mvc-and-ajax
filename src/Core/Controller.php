<?php
    namespace Todos\Core;
    class Controller
    {
        var $vars = [];
        var $layout = "default";

        function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

        function render($filename)
        {
            extract($this->vars);
            $fileloc = explode('.',$filename);
            $view = ROOT."\src\Views\\";
            for($i=0;$i<count($fileloc);$i++){
                if(array_key_exists($i+1,$fileloc)){
                    $view = $view .  $fileloc[$i]."\\";
                }else{
                    $view = $view .  $fileloc[$i].".php";
                }
            }

            if (file_exists($view)) {
                require($view);
            }
            else{
                echo "<strong> No file exists!!! => </strong>".$view."</br>";
            }

        }

        private function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        protected function secure_form($form)
        {
            foreach ($form as $key => $value)
            {
                $form[$key] = $this->secure_input($value);
            }
        }

    }
?>
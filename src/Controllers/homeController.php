<?php
    namespace Todos\Controllers;

    class homeController extends \Todos\Core\Controller
    {
        function index()
        {
            $tasks = new \Todos\Models\Todo();
            $d['todos'] = $tasks->showAllTasks();
            
            $this->set($d);
            $this->render("todo.index");
        }

        function create()
        {
            if ((isset($_POST["task"])) && ($_SERVER["REQUEST_METHOD"] == 'POST')) {

                $task = new \Todos\Models\Todo();

                if ($task->create($_POST["task"])) {
                    header("Location: http://localhost/todos/");
                }
            }
        }

        function ajaxview()
        {
            $tasks = new \Todos\Models\Todo();
            $d['todos'] = $tasks->showAllTasks();
            
            $this->set($d);
            echo json_encode($this->vars['todos']);
        }


        function edit($id)
        {
            $task = new \Todos\Models\Todo();

            if ((isset($_POST["task"])) && ($_SERVER["REQUEST_METHOD"] == 'POST'))
            {
                if ($task->edit($id, $_POST["task"]))
                {
                    // header("Location: http://localhost/todos/");
                }
            }
        }


        function check($id)
        {
            $task = new \Todos\Models\Todo();

            if ($_SERVER["REQUEST_METHOD"] == 'POST')
            {
                if ($task->checked($id, '1'))
                {
                    // header("Location: http://localhost/todos/");
                }
            }
        }

        function uncheck($id)
        {
            $task = new \Todos\Models\Todo();

            if ($_SERVER["REQUEST_METHOD"] == 'POST')
            {
                if ($task->unchecked($id, '0'))
                {
                    // header("Location: http://localhost/todos/");
                }
            }
        }

        function clear()
        {
            $task = new \Todos\Models\Todo();

            if ($_SERVER["REQUEST_METHOD"] == 'POST')
            {
                if ($task->cleared())
                {
                    // header("Location: http://localhost/todos/");
                }
            }
        }


        function delete($id)
        {
            $tasks = new \Todos\Models\Todo();
            if ($tasks->delete($id))
            {
                
            }
        }
    }
?>
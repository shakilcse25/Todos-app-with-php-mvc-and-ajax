<?php
namespace Todos\Models;
class Todo extends \Todos\Core\Model
{
    public function create($task)
    {
        $sql = "INSERT INTO tbl_todos (task, complete , created_at) VALUES (:task, :complete, :created_at)";

        $req = \Todos\Config\Database::getBdd()->prepare($sql);

        return $req->execute([
            'task' => $task,
            'complete' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function showTask($id)
    {
        $sql = "SELECT * FROM tbl_todos WHERE id =" . $id;
        $req = \Todos\Config\Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function showAllTasks()
    {
        $sql = "SELECT * FROM tbl_todos";
        $req = \Todos\Config\Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function edit($id, $task)
    {
        $sql = "UPDATE tbl_todos SET task = :task WHERE id = :id";

        $req = \Todos\Config\Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'task' => $task
        ]);
    }

    public function checked($id, $complete)
    {
        $sql = "UPDATE tbl_todos SET complete = :complete WHERE id = :id";

        $req = \Todos\Config\Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'complete' => $complete
        ]);
    }

    public function unchecked($id, $complete)
    {
        $sql = "UPDATE tbl_todos SET complete = :complete WHERE id = :id";

        $req = \Todos\Config\Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'complete' => $complete
        ]);
    }


    public function cleared()
    {
        $sql = 'DELETE FROM tbl_todos WHERE complete = :complete';

        $req = \Todos\Config\Database::getBdd()->prepare($sql);
        return $req->execute([
            'complete' => '1'
        ]);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM tbl_todos WHERE id = ?';
        $req = \Todos\Config\Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}

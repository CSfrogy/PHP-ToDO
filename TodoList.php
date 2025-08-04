<?php

require_once 'Dbh.php';

class TodoList {
    private $conn;


    public function __construct() {
        $dbh = new Dbh();
        $this->conn = $dbh-> getConnection();
    }

    public function addTask($task) {
        if(empty(trim($task)))return false;
        $stmt = $this->conn->prepare("INSERT INTO tasks (task) VALUES (?)");
        return $stmt->execute([$task]);
    }
    public function getTasks() {
        $stmt = $this->conn->prepare("SELECT * FROM tasks");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteTask($id) {
        if(!is_numeric($id))return false;
        $stmt = $this->conn->prepare("DELETE FROM tasks WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function updateTask($id, $task) {
        if(!is_numeric($id) || empty(trim($task))) return false;
        $stmt = $this->conn->prepare("UPDATE tasks SET task = ? WHERE id = ?");
        return $stmt->execute([$task, $id]);
    }

}

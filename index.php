<?php
    require_once("Dbh.php");
    require_once("TodoList.php");

    $todoList = new TodoList();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
        $task = $_POST["task"];
        $todoList->addTask($task);
        header("Location:  " .$_SERVER["PHP_SELF"]);
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
        $todoList->deleteTask($_POST["delete_id"]);
        header("location:  " .$_SERVER["PHP_SELF"]);
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_id"])) {
        $todoList->updateTask($_POST["update_id"], $_POST["updated_task"]);
        header("Location:  " .$_SERVER["PHP_SELF"]);
        exit();
    }

    $tasks = $todoList->getTasks();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SimpleDo</title>
</head>
<body>
    <div class="container">
        <h1>To-Do List</h1>
        <form method="POST" action="">
            <label for="task">Task</label>
            <input type="text" name="task" id="task" placeholder="Task here" required>
            <button type="submit">Add Task</button>
        </form>
        <ul id="task-list">
            <?php foreach ($tasks as $task) : ?>
                <li class="task-item">
                    <?php if(isset($_GET['edit']) && $_GET['edit'] == $task['id']): ?>
                        <!-- Edit Form -->
                        <form method="POST" class="edit-form">
                            <input type="hidden" name="update_id" value="<?= $task['id'] ?>">
                            <input type="text" name="updated_task" value="<?= htmlspecialchars($task['task']) ?>">
                            <button type="submit">Save</button>
                            <a href="?">Cancel</a>
                        </form>
                    <?php else: ?>
                        <!-- Task Display -->
                        <span><?= htmlspecialchars($task['task']) ?></span>
                        <div class="task-actions">
                            <a href="?edit=<?= $task['id'] ?>">Edit</a>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="delete_id" value="<?= $task['id'] ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>

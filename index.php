<?php
    include_once ("dbh.php");
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
        <form id="task-form">
            <label for="task">Task</label>
            <input type="text" id="task" placeholder="Task here">
            <button type="submit">Add Task</button>
        </form>
        <ul id="task-list">

        </ul>
    </div>
</body>
</html>

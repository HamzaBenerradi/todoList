<?php
include "db.php";
$id = $_GET["id"];
$task = $con->query("SELECT * FROM `todo-list` WHERE id = $id");
$row = $task->fetch_assoc();
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskname = $_POST["task"];
    if (!empty($taskname)) {
        $stmt = $con->prepare("UPDATE `todo-list` SET taskName = ? WHERE id = ?");
        $stmt->bind_param("si", $taskname, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <div class="todo-logo">
                <img src="imgs/todo-logo.png" alt="todo-logo">
            </div>
            <div class="todo-desc">
                </em>
                <h4>
                    Simple to-do list. Organize work & life.
                </h4>
                </em>
            </div>
        </nav>
    </header>
    <div class="container">
        <form method="POST">
            <div class="containers">
                <input value="<?= $row["taskName"] ?>" type="text" name="task" placeholder="Update Task..." class="form-control w-25 me-2">
                <button name="update" type="submit" class="addtask">Update</button>
            </div>
        </form>
    </div>
</body>

</html>
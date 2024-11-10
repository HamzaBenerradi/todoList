<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $taskname = $_POST["task"];
    if (!empty($taskname)) {
        $stmt = $con->prepare("INSERT INTO `todo-list` (taskName) VALUES(?)");
        $stmt->bind_param("s", $taskname);
        $stmt->execute();
        $stmt->close();
    }
}

$opentask = $con->query("SELECT * FROM `todo-list` where isCompleted = 0");
$closedtask = $con->query("SELECT * FROM `todo-list` where isCompleted = 1");
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
                <input type="text" name="task" placeholder="Task name..." class="form-control w-50 me-2">
                <button name="addTask" type="submit" class="addtask">Add</button>
            </div>
        </form>
        <div class="tasklist">
            <div>
                <h2 class="tasktitle">Tasks list :</h2>
                <table class="table table-danger text-center w-100">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($opentask->num_rows > 0): ?>
                            <?php while ($row = $opentask->fetch_assoc()): ?>
                                <tr>
                                    <td>- <?= $row["taskName"] ?></td>
                                    <td>
                                        <a href="complete.php?id=<?= $row["id"] ?>" class="btn btn-sm fw-bold btn-outline-success">Done</a>
                                        <a href="delete.php?id=<?= $row["id"] ?>" class="btn btn-sm fw-bold btn-outline-danger">Delete</a>
                                        <a href="update.php?id=<?= $row["id"] ?>" class="btn btn-sm fw-bold btn-outline-primary">Edit</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td>
                                    -No tasks founded !!
                                <td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div>
                <h2 class="tasktitle">Completed Task :</h2>
                <table class="table table-danger text-center w-100">
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($closedtask->num_rows > 0): ?>
                            <?php while ($row = $closedtask->fetch_assoc()): ?>
                                <tr>
                                    <td><s><?= $row["taskName"] ?></s></td>
                                    <td>
                                        <a href="delete.php?id=<?= $row["id"] ?>" class="btn btn-sm fw-bold btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td>
                                    -No completed tasks founded !!
                                <td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
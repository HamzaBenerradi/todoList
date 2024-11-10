<?php
include "db.php";
$id = $_GET["id"];
if ($id) {
    $stmt = $con->prepare("UPDATE `todo-list` SET isCompleted = 1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

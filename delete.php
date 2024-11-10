<?php
include "db.php";
$id = $_GET["id"];
if ($id) {
    $stmt = $con->prepare("DELETE FROM `todo-list` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: index.php");
    exit();
}

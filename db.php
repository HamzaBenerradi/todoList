<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "todolist");

$con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if ($con->connect_error) {
    die("Connection error : " . $con->connect_error);
}

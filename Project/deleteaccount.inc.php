<?php

include "db_connection.php";

session_start();

$userid = $_SESSION["user_id"];
$sql = "DELETE FROM user WHERE user_id = '$userid'";
mysqli_query($conn, $sql);

$sql = "DELETE FROM purchase WHERE user_id = '$userid'";
mysqli_query($conn, $sql);

$sql ="DELETE FROM registered WHERE user_id = '$userid'";
mysqli_query($conn, $sql);

header("Location: index.php?error=Your account has been deleted");
<?php
include("db_connection.php");
session_start();
?>
<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 60px;
        background-color: deepskyblue;
        color: #fff;
        font-size: 18px;
    }

    .navbar a {
        display: block;
        padding: 0 20px;
        color: #fff;
        text-decoration: none;
        line-height: 60px;
    }

    .navbar a:hover {
        background-color: #555;
    }

    .mid {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
        padding: 20px;
    }

    body {
        margin: 0;
        padding: 0;
    }

    /* Add some styling for the page title */
    h2 {
        margin: 0;
        padding: 10px;
        color: black;
        text-align: center;
    }

    /* Style the navigation links */
    .class1 a {
        display: inline-block;
        padding: 10px;
        background-color: deepskyblue;
        color: white;
        text-decoration: none;
        margin: 10px;
        border-radius: 5px;
    }

    .titlediv {
        text-align: center;
        padding: 20px 0;
    }

    /* Style the table */
    .table {
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px deepskyblue;
        padding: 10px;
    }
</style>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Authors</title>
</head>
<div class="navbar">
    <a href="home.php">HomePage</a>
    <a href="author_search.php">Author Search</a>
    <a href="#">Forum</a>
    <a href="#">Reviews</a>
    <a href="#">Profile</a>
    <a href="index.php">Logout</a>
</div>
<body>
<div class="titlediv">
    <h2  class="page">Author Page</h2>
</div>
<table class="mid">
    <?php $sql = "SELECT *  FROM author";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $userid = $row["user_id"];
            echo "
            <tr class='class1'>
            <td> Author :<a href='authorbooks.php?user_id=$userid&name=$name' > ", $row["name"], "</td> 
            </tr> ";
        }
    } else {
        echo "No Results";
    }
    ?>
</table>
</form>
</body>
</html>

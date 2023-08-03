<?php
include("db_connection.php");
session_start();
?>
<style>
    /* Add some style to the body element */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Style the header elements */
    header {
        background-color: lightblue;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
    }

    /* Style the navigation links */
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

    /* Style the table */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<!DOCTYPE html>
<html lang="">
<head>
    <title>HOME PAGE</title>
</head>
<body>

<div class="navbar">
    <a href="home.php">HomePage</a>
    <a href="author_search.php">Author Search</a>
    <a href="#">Forum</a>
    <a href="#">Reviews</a>
    <a href="#">Profile</a>
    <a href="index.php">Logout</a>
</div>

<table>
    <?php
    $authorid = $_GET["user_id"];
    $sql = "SELECT DISTINCT B.book_id, B.title, G.genre_name, B.rating FROM ebook EB, book B, author A, publish P, genre G, belongs BE WHERE EB.book_id = B.book_id AND P.user_id = A.user_id AND A.user_id = '$authorid' AND BE.book_id = B.book_id AND BE.genre_id = G.genre_id AND P.book_id = B.book_id";
    $result = mysqli_query($conn, $sql);

    echo "<table>";
    while ($row = $result->fetch_assoc()) {
        $bookid = $row["book_id"];
        $booktitle = $row["title"];
        $genrename = $row["genre_name"];
        $bookrating = $row["rating"];
        echo "<tr><td>Book title: ", $row["title"], "</td>
                    <td>Book genre: ", $row["genre_name"], "</td>
                    <td>Book Rating : ", $row['rating'], "</td>
                    <td><a href='reviewbook.php?booktitle=", $booktitle, "&genrename=", $genrename, "&bookrating=", $bookrating, "&bookprice=", "&bookid=", $bookid, "'>   Review</a></td>
                </tr>";
    }
    echo "</table>";
    ?>
</table>
</form>
</body>
</html>
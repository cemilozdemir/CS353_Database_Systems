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

    body {
        padding: 0;
        margin: 0;
    }

    table {
        align-content: center;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    h2 {
        text-align: center;
    }

    h3 {
        margin-top: 20px;
    }

    h4 {
        margin-left: 20px;
    }

</style>
<!DOCTYPE html>
<html lang="">
<head>
    <div class="navbar">
        <a href="home.php">HomePage</a>
        <a href="author_search.php">Author Search</a>
        <a href="#">Forum</a>
        <a href="#">Reviews</a>
        <a href="#">Profile</a>
        <a href="index.php">Logout</a>
    </div>
    <title>Reports PAGE</title>
</head>
<body>
<h2>Reports</h2>
<table>
    <?php
    $user_count_sql = "SELECT COUNT(user_id) as count_user FROM user";
    $book_prices_sql = "SELECT EB.price, title FROM book B, ebook EB WHERE B.book_id = EB.book_id
                                              GROUP BY title ORDER BY price desc LIMIT 5";

    $cheapest_sql = "SELECT B.title, MIN(price) as price FROM ebook EB, book B WHERE EB.book_id = B.book_id";

    $result1 = mysqli_query($conn, $user_count_sql);
    $result2 = mysqli_query($conn, $book_prices_sql);
    $result3 = mysqli_query($conn, $cheapest_sql);

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $user_count = $row["count_user"];

            echo "<h3> Current User Count </h3>";
            echo "<h4>User Count: ", $row["count_user"], "</h4>";
        }
    } else {
        echo "No Results";
    }

    echo "<h3> Minimum price </h3>";

    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $price = $row["price"];
            $title = $row["title"];
            echo "<h4>  $title    ", $price, "</h4>";
        }
    }
    echo "<h3> Most Expensive 5 books  </h3>";
    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $title = $row["title"];
            echo "
                            <tr>
                            <td>  $title ", $row["price"], "</td>
                            </form></td>
                         </tr> ";
        }
    }

    ?>
</table>


</body>
</html>
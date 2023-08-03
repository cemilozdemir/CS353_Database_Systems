<?php
include("db_connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="">
<style>
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

    body {
        padding: 0;
        margin: 0;
        border-style: none;
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
        margin-left: 7%;
        border-radius: 5px;
    }

    /* Style the error message */
    .error {
        color: red;
        font-style: italic;
        margin-bottom: 10px;
    }

    /* Style the table */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid black;
        padding: 10px;
    }

    /* Style the "Publish Book" button */
    input[type="submit"] {
        background-color: blue;
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
    }
    .publishClass {
        border-style: none;
        display: inline-block;
        align-content: center;
        margin-left: 47%;
        padding: 15px;
        background-color: deepskyblue;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
</style>
<head>
    <div class="navbar">
        <a href="home.php">HomePage</a>
        <a href="author_search.php">Author Search</a>
        <a href="#">Forum</a>
        <a href="#">Reviews</a>
        <a href="#">Profile</a>
        <a href="index.php">Logout</a>
    </div>
    <title>HOME PAGE</title>
</head>
<body>

<div class="titlediv">
    <h2 class="page">Home Page</h2>
</div>

</div>
<div>
    <?php if ($_SESSION['money_amount'] >= 0)
        echo "<h2> Welcome ", $_SESSION["name"], " - Wallet: $", $_SESSION["wallet"], " - Author Account: $", $_SESSION["money_amount"], "</h2>";
    else
        echo "<h2> Welcome ", $_SESSION["name"], " Wallet: $", $_SESSION["wallet"], "</h2>"; ?>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
</div>
<div class="class1">
    <a href="purchasedBooks.php">Purchased books</a>
    <a href="addmoney.php">Add money</a>
    <a href="index.php">Logout</a>
    <a href="deleteaccount.php"> Delete my account</a>
    <a href="search.php">Search</a>
    <a href="author.php">Author</a>
    <a href="reports.php">Reports</a>
</div>
<br>
<table>
    <?php
    $sql = "SELECT * FROM normal_book_view";
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
<form action="publishbook.php" method="post">
    <br>
    <?php
    if ($_SESSION['money_amount'] >= 0)
        echo '<button class = "publishClass"  type = "submit"> Publish Book</button>'
    ?>
</form>
</body>
</html>
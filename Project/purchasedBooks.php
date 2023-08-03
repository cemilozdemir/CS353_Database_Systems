<?php
include("db_connection.php");
session_start();
?>
<style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
    }

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


    h2 {
        color: #333;
        font-size: 24px;
        text-align: center;
        margin: 20px 0;
    }

    a {
        display: inline-block;
        text-decoration: none;
        color: #333;
        font-size: 18px;
        margin-right: 20px;

        transition: all 0.3s ease;
    }

    a:hover {
        color: #00bfff;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
        font-size: 16px;
    }

    th {
        background-color: #00bfff;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f5f5f5;
    }

    form {
        margin-bottom: 20px;
    }

    button[type="submit"] {
        width: 100%;
        height: 40px;
        border: none;
        border-radius: 5px;
        background-color: #00bfff;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #0099cc;
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
    <title>BOOKS PAGE</title>
</head>
<body>
<h2><?php echo $_SESSION['name']; ?> - Your Purchased Books</h2>
<?php if (isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
<?php } ?>
<br>
<table>
    <?php
    $userid = $_SESSION["user_id"];
    $sql = "SELECT B.title, G.genre_name, EB.pdf_link  FROM book B, genre G, belongs BE, ebook EB, purchase P WHERE BE.book_id = B.book_id AND G.genre_id = BE.genre_id AND EB.book_id = B.book_id AND P.user_id = '$userid' AND P.book_id = B.book_id ";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $booktitle = $row["title"];
            $genrename = $row["genre_name"];
            $pdflink = $row["pdf_link"];

            echo "<tr><td>Book title: ", $row["title"], "</td>
                            <td>Book genre: ", $row["genre_name"], "
                            <form action='/viewpdf.php' method='post'>
                              <input type='hidden' name='filepath' value='$pdflink'>
                              <button type='submit'>View PDF</button>
                            </form>
</td> </tr>";
        }
    } else {
        echo "No Results";
    }
    ?>
</table>
</body>
</html>
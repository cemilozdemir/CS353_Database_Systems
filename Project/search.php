<?php
include("db_connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Search PAGE</title>
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
            border-style: none;
        }
        /* Add your updated CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
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
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        label {
            margin-top: 10px;
            display: block;
            font-size: 16px;
            color: #333;
        }
        input[type="text"], input[type="date"], select {
            width: 100%;
            height: 40px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
            padding: 0 10px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button[type="submit"] {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            background-color: #00bfff;
            color: white;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0099cc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>

</head>
<body>
<body>
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
<h2>Search</h2>
<form method="post">
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <br>
    <label>Book Title:</label>
    <input type="text" name="bookTitle" id="bookTitle" placeholder="Book Title">
    <br>
    <label>Genre:</label>
    <select name="genre" id="genre">
        <option value="">All</option>
        <option value="action">Action</option>
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
        <option value="fantasy">Fantasy</option>
        <option value="horror">Horror</option>
        <option value="romance">Romance</option>
    </select>
    <br>
    <label>From:</label>
    <input type="date" name="publishDate1" id="publishDate1" placeholder="From" value="2000-10-10">
    <br>
    <label>To:</label>
    <input type="date" name="publishDate2" id="publishDate2" placeholder="To" value="2023-10-10">
    <br>
    <label>just E-book:</label>
    <select name="ebook" id="ebook">
        <option value="no">no</option>
        <option value="yes">yes</option>
    </select>
    <br>
    <button type="submit" name="test" id="test"> Search</button>
    <table>
        <?php
        $title = "";
        $genre = "";
        $ebook = "no";
        if (array_key_exists('test', $_POST)) {
            $title = $_POST['bookTitle'];
            $genre = $_POST['genre'];
            $date1 = $_POST['publishDate1'];
            $date2 = $_POST['publishDate2'];
            $ebook = $_POST['ebook'];
            if ($ebook == "yes") {
                $sql = "SELECT B.title, G.genre_name FROM book B, genre G, belongs BE, ebook EB
                         WHERE BE.book_id = B.book_id AND G.genre_id = BE.genre_id
                                AND B.title LIKE '$title%' AND G.genre_name LIKE '$genre%'
                                AND B.publish_date BETWEEN '$date1' AND '$date2'
                                   AND B.book_id = EB.book_id";
            } else {
                $sql = "SELECT B.title, G.genre_name FROM book B, genre G, belongs BE
                         WHERE BE.book_id = B.book_id AND G.genre_id = BE.genre_id
                                AND B.title LIKE '$title%' AND G.genre_name LIKE '$genre%'
                                AND B.publish_date BETWEEN '$date1' AND '$date2'";
            }
        } else {
            $sql = "SELECT B.title, G.genre_name FROM book B, genre G, belongs BE 
                         WHERE BE.book_id = B.book_id AND G.genre_id = BE.genre_id
                                ";
        }
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            echo "<tr>
                <th>Book Title</th>
                <th>Genre</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>";
            while ($row = $result->fetch_assoc()) {
                $booktitle = $row["title"];
                $genre = $row["genre_name"];
                echo "<tr>
            <td>$booktitle</td>
            <td>$genre</td>
            <td><a href='update.php?title=$booktitle'>Edit</a></td>
            <td><a href='delete.php?title=$booktitle'>Delete</a></td>
          </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </table>
</form>
</body>
</html>
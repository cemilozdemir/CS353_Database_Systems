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


    .titlediv {
        text-align: center;
        padding: 20px 0;
    }

    .page {
        font-size: 36px;
        font-weight: normal;
        margin: 0;
    }

    .mid {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    label {
        font-size: 18px;
        margin-bottom: 5px;
    }

    input[type="text"] {
        width: 300px;
        height: 35px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
        padding: 0 10px;
    }

    button[type="submit"] {
        width: 150px;
        height: 35px;
        border: none;
        border-radius: 3px;
        background-color: #00b8d4;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #00a0c6;
    }

    .author {
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 16px;
    }

    td a {
        color: #00b8d4;
    }

    .error {
        color: red;
        font-size: 14px;
        margin-bottom: 20px;
    }

</style>

<!DOCTYPE html>
<html lang="">
<head>
    <title>Author Search</title>
    <div class="navbar">

        <a href="home.php">HomePage</a>
        <a href="author_search.php">Author Search</a>
        <a href="#">Forum</a>
        <a href="#">Reviews</a>
        <a href="#">Profile</a>
        <a href="#">Logout</a>

    </div>
</head>
<body>
<div class="titlediv">
    <h2 class="page">Author Search Page</h2>
</div>
<div class="mid">
    <form method="post">
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <br>
        <label>Author Name:</label>
        <input type="text" name="name" id="name" placeholder="Author name">
        <br>
        <button class="publish-button" type="submit" name="test" id="test"> Search</button>

        <div class="author">
            <table>
                <?php
                $name = "";
                if (array_key_exists('test', $_POST)) {
                    $name = $_POST['name'];
                    $sql = "SELECT A.name, A.money_amount, A.user_id FROM author A
                             WHERE A.name  LIKE '$name%'";
                } else {
                    $sql = "SELECT * FROM author";
                }
                $result = mysqli_query($conn, $sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $userid = $row["user_id"];
                        echo "<tr>
                      <td>  Author :<a href='authorbooks.php?user_id=$userid&name=$name' > ", $row["name"], "</td> 
                         </tr> ";
                    }
                } else {
                    echo "No Results";
                }
                ?>
            </table>
        </div>
    </form>
</div>
</body>
</html>
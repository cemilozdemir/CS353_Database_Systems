<?php

include("db_connection.php");

session_start();

?>
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        display: block;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
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
        color: #fff;
        text-decoration: none;
        line-height: 60px;
    }

    .navbar a:hover {
        background-color: #555;
    }

    h2 {
        font-size: 36px;
        font-weight: 500;
        color: #333;
        margin: 20px 0;
    }


    a:hover {
        color: #2980b9;
    }

    form {
        display: flex;
        align-items: center;
    }

    select {
        font-size: 32px;
        padding: 16px 20px;
        border: 2px solid #ccc;
        border-radius: 8px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: #fff;
    }

    button {
        font-size: 32px;
        padding: 16px 40px;
        border: none;
        border-radius: 8px;
        background-color: #3498db;
        color: #fff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #2980b9;
    }

    .price {
        display: block;
        margin-left: 40%;
        margin-top: 15%;
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
        <a href="#">Logout</a>

    </div>
    <title>PURCHASE PAGE</title>

</head>
<body>
<div class="price">
    <h2>Price: $<?php echo $_GET['bookprice'] ?></h2>
    <h2> Wallet: $<?php echo $_SESSION['wallet'] ?></h2>


    <br>
    <form action='' method="POST">
        <select name="buy" id="buy">
            <option value="1">Wallet</option>
            <option value="2">Card</option>

        </select>
        <button type="submit">Buy</button>
    </form>
</div>

<?php if (isset($_POST['buy'])) {
    $date = date("Y-m-d");

    $buytype = $_POST["buy"];
    $userid = $_SESSION['user_id'];
    $wallet = $_SESSION["wallet"];
    $wallet = floatval($wallet);
    $price = $_GET['bookprice'];
    $price = floatval($price);
    $remaining = $wallet - $price;
    $bookid = $_GET['bookid'];
    if ($buytype == "1") {

        if ($remaining >= 0) {
            $sql = "UPDATE registered
        SET wallet = '$remaining'
        WHERE user_id IN (SELECT user_id FROM user WHERE user_id = '$userid');;";
            mysqli_query($conn, $sql);
            $_SESSION['wallet'] = $remaining;

            $sql = "INSERT INTO purchase (user_id, book_id, purchase_date) values ('$userid', '$bookid', '$date')";
            mysqli_query($conn, $sql);


            $sql = "SELECT U.user_id, U.money_amount  FROM book B, publish P, author U WHERE B.book_id = P.book_id AND U.user_id = P.user_id AND B.book_id = '$bookid' ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $authorid = $row["user_id"];
            $authormoney = $row["money_amount"];
            $newmoney = $price + $authormoney;

            $sql = "UPDATE author SET money_amount = '$newmoney' WHERE user_id = '$authorid'";
            mysqli_query($conn, $sql);
            header("Location: home.php?error=You have successfully purchased ");

        } else
            echo "You don't have enough money in your account";

    } else {
        $sql = "INSERT INTO purchase (user_id, book_id, purchase_date) values ('$userid', '$bookid', '$date')";
        mysqli_query($conn, $sql);

        $sql = "SELECT U.user_id, U.money_amount  FROM book B, publish P, author U WHERE B.book_id = P.book_id AND U.user_id = P.user_id AND B.book_id = '$bookid' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $authorid = $row["user_id"];
        $authormoney = $row["money_amount"];
        $newmoney = $price + $authormoney;

        $sql = "UPDATE author SET money_amount = '$newmoney' WHERE user_id = '$authorid'";
        mysqli_query($conn, $sql);
        header("Location: home.php?error=You have successfully purchased ");
    }
}
?>
</body>
</html>
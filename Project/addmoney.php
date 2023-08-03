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
        font-family: Arial, sans-serif;
        text-align: center;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    h2 {
        color: #333333;
        margin: 20px 0;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    input[type="number"] {
        width: 300px;
        height: 35px;
        border: 1px solid #cccccc;
        border-radius: 4px;
        padding: 0 10px;
        margin: 10px 0;
    }

    button[type="submit"] {
        width: 100px;
        height: 35px;
        border: none;
        border-radius: 4px;
        background-color: deepskyblue;
        color: #ffffff;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #555;
    }


</style>
<!DOCTYPE html>
<html lang="">

<head>
    <title>WALLET PAGE</title>
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
<h2> Wallet: $<?php echo $_SESSION['wallet'] ?></h2>
<form action='' method="POST">
    <input type="number" min="1" name="price" placeholder="Price" step="any"/>
    <button type="submit">Add</button>
</form>
<?php if (isset($_POST['price'])) {
    $amount = $_POST["price"];
    $currentmoney = $_SESSION["wallet"];
    $currentmoney = floatval($currentmoney);
    $userid = $_SESSION['user_id'];
    $totalmoney = $currentmoney + $amount;
    $totalmoney = (string)$totalmoney;
    $sql = "UPDATE registered
        SET wallet = '$totalmoney'
        WHERE user_id IN (SELECT user_id FROM user WHERE user_id = '$userid');
;
";
    mysqli_query($conn, $sql);
    $_SESSION['wallet'] = $totalmoney;
    header("Location: home.php?error=Your wallet is updated");
}
?>
</body>
</html>
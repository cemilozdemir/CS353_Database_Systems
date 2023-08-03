<?php
session_start();
include "db_connection.php";
if (isset($_SESSION['cid']) && isset($_SESSION['name'])){
    $uname = $_SESSION['name'];
    $pass = $_SESSION['cid'];






    ?>

    <!DOCTYPE html>
    <html lang="">
    <head>
        <title>LOGIN</title>
    </head>
    <body>

    <h1>Hello, <?php echo $_SESSION['name']; ?> </h1>
    <a href="customer.php">Previous Page</a>
    <a href="index.php">Logout</a>

    <table>
        <h2>All accounts</h2>
        <tr>
            <th>Account ID</th>
            <th>Branch</th>
            <th>Balance</th>
            <th>Open Date</th>
            <?php $sql = "SELECT DISTINCT A.aid, A.branch, A.balance, A.openDate FROM account A, owns O, customer C WHERE A.aid = O.aid AND C.cid = O.cid ";

            $result =  mysqli_query($conn, $sql );

            if ($result->num_rows > 0 ){
                while ($row = $result-> fetch_assoc()){
                    echo "<tr><td>", $row["aid"], "</td>
                            <td>", $row["branch"], "</td>
                            <td>", $row["balance"], "</td>
                            <td>", $row["openDate"], "
                         </td>
                         </tr> ";
                }
            }else {
                echo "No Results";
            }
            ?>
        </tr>
    </table>
<form action = "action.php" method = 'post'>

    <?php if (isset($_GET['error'])){ ?>
        <p class = "error"><?php echo  $_GET['error']; ?></p>
    <?php }?>
    <input type = "text" name = "fromAccount" placeholder = "Transfer From (AID)">
    <input type = "text" name = "toAccount" placeholder = "Transfer to (AID)">

    <input type = "text" name = "transferAmount" placeholder = "Amount">
    <button type = "submit"> Submit </button>
</form>
    <table>
        <h2>Your accounts</h2>
        <tr>
            <th>Account ID</th>
            <th>Branch</th>
            <th>Balance</th>
            <th>Open Date</th>
            <?php $sql = "SELECT DISTINCT A.aid, A.branch, A.balance, A.openDate FROM account A, owns O, customer C WHERE A.aid = O.aid AND C.cid = O.cid AND O.cid = '$pass'";

            $result =  mysqli_query($conn, $sql );

            if ($result->num_rows > 0 ){
                while ($row = $result-> fetch_assoc()){
                    echo "<tr><td>", $row["aid"], "</td>
                            <td>", $row["branch"], "</td>
                            <td>", $row["balance"], "</td>
                            <td>", $row["openDate"], "
                         </td>
                         </tr> ";
                }
            }else {
                echo "No Results";
            }
            ?>
        </tr>
    </table>


    </body>
    </html>

    <?php
}else{
    header("Location: index.php");
    exit();
}
?>


<?php
session_start();
include "db_connection.php";
if (isset($_SESSION['cid']) && isset($_SESSION['name'])){
    $uname = $_SESSION['name'];
    $pass = $_SESSION['cid'];

    if (isset($_GET['aid'])){
        $id = $_GET['aid'];
        $delete = mysqli_query($conn, "DELETE FROM owns WHERE cid = '$pass' AND aid = '$id'");
        if ($delete)
            echo "Successfully deleted";
        else
            echo "Error has occurred";
    }




?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>LOGIN</title>
</head>
<body>

    <h1>Hello, <?php echo $_SESSION['name']; ?> </h1>
    <a href="index.php">Logout</a>

<table>
    <tr>
        <th>Account ID</th>
        <th>Branch</th>
        <th>Balance</th>
        <th>Open Date</th>
        <?php $sql = "SELECT A.aid, A.branch, A.balance, A.openDate FROM account A, owns O, customer C WHERE A.aid = O.aid AND C.cid = O.cid AND O.cid = '$pass'";

        $result =  mysqli_query($conn, $sql );

        if ($result->num_rows > 0 ){
            while ($row = $result-> fetch_assoc()){
                echo "<tr><td>", $row["aid"], "</td>
                            <td>", $row["branch"], "</td>
                            <td>", $row["balance"], "</td>
                            <td>", $row["openDate"], "
                        <a href = 'customer.php?aid=".$row["aid"]."' class = 'btn'> Close </a> </td>
                         </tr> ";
            }
        }else {
            echo "No Results";
        }
        ?>
    </tr>
</table>

<a href="transfer.php">Money Transfer</a>
</body>
</html>

<?php
}else{
     header("Location: index.php");
                exit();
}
?>


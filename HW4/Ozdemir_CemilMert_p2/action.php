<?php
include ("db_connection.php");
session_start();

if(isset($_POST['fromAccount']) && isset($_POST['toAccount'])){

    $from = ($_POST['fromAccount']);
    $to = ($_POST['toAccount']);
    $amount = ($_POST['transferAmount']);
    $pass = $_SESSION['cid'];
    $check = False;

    $sql = "SELECT DISTINCT A.aid FROM account A, owns O, customer C WHERE A.aid = O.aid AND C.cid = O.cid AND O.cid = '$pass'";
    $result =  mysqli_query($conn, $sql );


    if ($result->num_rows > 0 ){
        while ($row = $result-> fetch_assoc()){
            if ($row['aid'] === $from)
                $check = True;
        }
    }else {
        echo "No Results";
    }

    if (empty($from)){
        header("Location: transfer.php?error=Account from is required ");
        exit();
    }else if (empty($to)){
        header("Location: transfer.php?error=Account to required");
        exit();
    }
    else if (empty($amount)){
        header("Location: transfer.php?error=Amount is required");
        exit();
    }
    else if (!$check){
        header("Location: transfer.php?error=Please select one of your accounts to transfer from");
        exit();
    }
    else{
        $sql1 = "SELECT balance FROM account WHERE aid = '$from'";
        $result = mysqli_query($conn, $sql1 );
        $num = mysqli_fetch_assoc($result);

        if ($num['balance'] < $amount){
            header("Location: transfer.php?error=Insufficient amount");
            exit();
        }

        $remaining = $num['balance'] - $amount;



        $sql2=  "UPDATE account SET balance = '$remaining' WHERE aid = '$from'";
        $result = mysqli_query($conn, $sql2);


        $sql3 = "SELECT balance FROM account WHERE aid = '$to'";
        $result = mysqli_query($conn, $sql3);
        $num = mysqli_fetch_assoc($result);

        $newTotal = $amount + $num['balance'];
        $sql4 = "UPDATE account SET balance = '$newTotal' WHERE aid = '$to'";
        $result = mysqli_query($conn, $sql4);

        echo "Transfer was successful";

        echo "<br><a href='transfer.php'>Go back</a> ";


    }
}
else{
    header("Location : index.php");
    exit();
}
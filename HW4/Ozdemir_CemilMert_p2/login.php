<?php
include ("db_connection.php");
session_start();

if(isset($_POST['uname']) && isset($_POST['uname'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)){
        header("Location: index.php?error=Username is required ");
        exit();
    }else if (empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    }
    else{
        $sql = "SELECT * FROM customer WHERE name = '$uname' AND cid = '$pass'";

        $result = mysqli_query($conn, $sql );


        if (mysqli_num_rows($result)){
        $row = mysqli_fetch_assoc($result);
            if (strcasecmp($row['name'],$uname) == 0 && $row['cid'] === $pass){
                $_SESSION['name'] = $row['name'];
                $_SESSION['cid'] = $row['cid'];
                header("Location: customer.php");
                exit();

            } else{
                header("Location: index.php?error=Incorrect user name or password");
                exit();
            }

        }
        else{
            header("Location: index.php?error=Incorrect user name or password");
            exit();
        }
    }
}
else{
    header("Location : index.php");
    exit();
}
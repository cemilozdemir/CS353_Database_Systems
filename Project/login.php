<?php
include ("db_connection.php");
session_destroy();
session_start();


if(isset($_POST['email']) && isset($_POST['password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if (empty($email)){
        header("Location: index.php?error=Email is required ");
        exit();
    }else if (empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    }
    else{
        $sql = "SELECT * FROM registered WHERE email = '$email' AND hashed_password = '$pass'";
        $result = mysqli_query($conn, $sql );
        if (mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            if (strcasecmp($row['email'],$email) == 0 &&$row['hashed_password'] == $pass){
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['name'] = $row['name'];
                $name = $row['name'];
                $author_sql = "SELECT * FROM author A WHERE A.name = '$name'";
                $author_result = mysqli_query($conn, $author_sql );
                if(mysqli_num_rows($author_result)){
                    $row1 = mysqli_fetch_assoc($author_result);
                    $_SESSION['money_amount'] = $row1['money_amount'];
                    $_SESSION['author'] = $row1['name'];
                }
                else{
                    $_SESSION['money_amount'] = "";
                    $_SESSION['author'] = "";
                }
                $_SESSION['wallet'] = $row['wallet'];

                header("Location: home.php");
                exit();
            } else{
                header("Location: index.php?error=Incorrect email or password");
                exit();
            }
        }
        else{
            header("Location: index.php?error=Incorrect Email name or password");
            exit();
        }
    }
}
else{
    header("Location : index.php");
    exit();
}
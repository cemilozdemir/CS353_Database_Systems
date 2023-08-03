<?php

include ("db_connection.php");

session_start();

if (isset($_POST['email']) && isset($_POST['uname']) && isset($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }



}
$email = validate($_POST['email']);
$uname = validate($_POST['uname']);
$password = validate($_POST['password']);
$type = validate($_POST["usertype"]);

$sql = "SELECT * FROM registered";
$result = mysqli_query($conn, $sql);

$check = false;
if ($result->num_rows > 0 ){
    while ($row = $result-> fetch_assoc()){
        if ($row['email'] === $email)
            $check = True;
    }


}

if ($check){
    header("Location: register.php?error=Email already exists");
    exit();
}

if (empty($email)){
    header("Location: register.php?error=Email is required");
    exit();
}
else if (empty($uname)){
    header("Location: register.php?error=User name is required");
    exit();
}
else if (empty($password)){
    header("Location: register.php?error=Password is required");
    exit();

}
else if($type == 0){
    header("Location: register.php?error=Please select user type");
    exit();
}
else{
    $sql = "SELECT MAX(CAST(user_id AS INT)) as maxNum FROM user";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_fetch_assoc($result);

    $max = $num['maxNum'];
    $max = $max + 1;
    $sql = "INSERT INTO registered (user_id, name, hashed_password, email, wallet) values ('$max', '$uname', '$password', '$email', '0')";
    mysqli_query($conn, $sql);
    $sql = "INSERT INTO user (user_id) values ('$max')";
    mysqli_query($conn, $sql);

    if ($type == 1){
        $sql = "INSERT INTO author (user_id, name, money_amount) values ('$max', '$uname', '0')";
        mysqli_query($conn, $sql);
    }

    header("Location: index.php?error=Successfully created user");


}
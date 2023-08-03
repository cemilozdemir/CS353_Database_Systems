<?php

include ("db_connection.php");

if (isset($_POST['bookTitle']) && isset($_POST['genre']) ){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    $bookTitle = validate($_POST['bookTitle']);
    $genre = $_POST['genre'];



    if (empty($bookTitle)){
        header("Location: search.php?error=Book title is required");
        exit();
    }

    if (empty($genre)){
        header("Location: search.php?error=Genre is required");
        exit();
    }

    else{
//        $sql = "SELECT MAX(CAST(book_id AS INT)) as maxNum FROM book";
//        $result = mysqli_query($conn, $sql);
//        $num = mysqli_fetch_assoc($result);
//
//        $max = $num['maxNum'];
//        $max = $max + 1;
//        $date = date("Y-m-d");
//        $sql = "INSERT INTO book (book_id, title, rating, publish_date) values ('$max', '$bookTitle', '0', '$date')";
//        mysqli_query($conn, $sql);
//
//        $sql = "SELECT * from genre where genre_name = '$genre'";
//        $result = mysqli_query($conn, $sql);
//        $row = mysqli_fetch_assoc($result);
//        $idOfGenre = $row['genre_id'];
//        $sql = "INSERT INTO belongs (book_id, genre_id) values ('$max', '$idOfGenre')";
//        mysqli_query($conn, $sql);
//
//
//        header("Location: publishbook.php?error=Successfully published book $bookTitle");


    }

}
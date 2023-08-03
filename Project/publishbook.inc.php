<?php

include ("db_connection.php");

session_start();


if (isset($_POST['bookTitle']) && isset($_POST['genre']) ){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }



}
$bookTitle = validate($_POST['bookTitle']);
$genre = $_POST['genre'];
$bookPrice =validate($_POST['bookPrice']);



if (empty($bookTitle)){
    header("Location: publishbook.php?error=Book title is required");
    exit();
}

if (empty($genre)){
    header("Location: publishbook.php?error=Genre is required");
    exit();
}

$targetfolder = "testupload/";

$targetfolder = $targetfolder . basename( $_FILES['file']['name']) ;

$ok=1;

$file_type=$_FILES['file']['type'];

if ($file_type=="application/pdf") {

    if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))

    {

        header("The file ". basename( $_FILES['file']['name']). " is uploaded");

    }

    else {

        header("Location: publishbook.php?error=Problem uploading file");
        exit();
    }

}

else {

    header("Location: publishbook.php?error=You may only upload PDF files, $file_type ");
    exit();

}


$sql = "SELECT MAX(CAST(book_id AS INT)) as maxNum FROM book";
$result = mysqli_query($conn, $sql);
$num = mysqli_fetch_assoc($result);

$max = $num['maxNum'];
$max = $max + 1;
$date = date("Y-m-d");
$sql = "INSERT INTO book (book_id, title, rating, publish_date) values ('$max', '$bookTitle', '0', '$date')";
mysqli_query($conn, $sql);

$bookPrice = floatval($bookPrice);
$pdf = basename($_FILES['file']['name']);
$sql = "INSERT INTO ebook (book_id, pdf_link, price) values ('$max', 'testupload/$pdf', '$bookPrice')";
mysqli_query($conn, $sql);

$sql = "SELECT * from genre where genre_name = '$genre'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$idOfGenre = $row['genre_id'];
$sql = "INSERT INTO belongs (book_id, genre_id) values ('$max', '$idOfGenre')";
mysqli_query($conn, $sql);

$userid = $_SESSION["user_id"];
$sql = "INSERT INTO publish (user_id, book_id) values ('$userid', '$max')";
mysqli_query($conn, $sql);


header("Location: home.php?error=Successfully published book $bookTitle");
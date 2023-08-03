<?php
include ("db_connection.php");
session_start();
?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
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
        padding: 0 20px;
        color: #fff;
        text-decoration: none;
        line-height: 60px;
    }

    .navbar a:hover {
        background-color: #555;
    }

    .up-div {
        width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .purch {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .mid {
        width: 800px;
        margin: 0 auto;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    textarea {
        width: 500px;
        height: 150px;
        font-size: 18px;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    #rating {
        width: 150px;
        height: 40px;
        font-size: 18px;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        margin-left: 50px;
        width: 150px;
        height: 40px;
        font-size: 18px;
        background-color: deepskyblue;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 17px;
    }

    button:hover {
        background-color: #555;
    }

    .error {
        color: red;
        font-size: 14px;
    }
    .loop{
        border: 1px solid;
        border-radius: 5px;
        padding-bottom: 10px;
    }
    .bos{
        display: flex;
    }
</style>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Reviews</title>
    <div class="navbar">
        <a href="home.php">HomePage</a>
        <a href="#">Books</a>
        <a href="#">Forum</a>
        <a href="#">Reviews</a>
        <a href="#">Profile</a>
        <a href="index.php">Logout</a>

    </div>
</head>
<body>
<div class="mid">
    <form action='' method="POST">
        <?php if (isset($_GET['error'])){ ?>
            <p class = "error"><?php echo  $_GET['error']; ?></p>
        <?php }?>
        <div class="inner">
            <h4> Below you can submit your review</h4>
            <textarea name="titleTextArea" cols="30" rows="2" placeholder="Title of the review"></textarea>
            <br>
            <textarea name="reviewTextArea" cols="30" rows="10" placeholder="Leave a review"></textarea>
            <br>
            <div class="bos">
                <p>Your rating :
                    <select name="rating" id="rating">
                        <option value="rate">Rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>

                    </select>
                </p>
                <br>
                <button class="publish-button" type="submit">Submit</button>
            </div>
        </div>
    </form>

</div>
<div class="up-div">
    <?php
    $reviewCount = 0;
    $reviewTotal = 0;
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }
    $booktitle = validate($_GET['booktitle']);
    $genrename = validate($_GET['genrename']);
    $bookrating = validate($_GET['bookrating']);
    $bookid = validate($_GET['bookid']);
    $userid = $_SESSION["user_id"];
    $check = 0;

    $sql = "SELECT price FROM book_view WHERE book_id = '$bookid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $bookprice = $row['price'];

    $sql = "SELECT B.book_id  FROM book B, genre G, belongs BE, ebook EB, purchase P WHERE BE.book_id = B.book_id AND G.genre_id = BE.genre_id AND EB.book_id = B.book_id AND P.user_id = '$userid' AND P.book_id = B.book_id ";
    $result = mysqli_query($conn, $sql);
    if($result-> num_rows > 0){
        while($row = $result -> fetch_assoc()){
            $book_id_check = $row["book_id"];
            if ($bookid == $book_id_check)
                $check = 1;
        }
    }
    if ($check == 0){
        echo "<h2 class='purch'> $booktitle  Rating: $bookrating Price:$$bookprice</h2> ", "<a href='purchasebook.php?book_id=", $bookid,"&bookprice=", $bookprice, "&bookid=", $bookid, " '>Purchase this book</a>";
    }
    else{
        echo "<h2 class='purch'> $booktitle  Rating: $bookrating Price: $bookprice</h2> ", "You already have this book";
    }


    $sql = "SELECT R.title, R.body FROM review R, has H, book B WHERE R.review_id = H.review_id AND B.book_id = H.book_id AND B.title = '$booktitle'";
    $result = mysqli_query($conn, $sql);
    if($result-> num_rows > 0){

        while($row = $result -> fetch_assoc()){
            ?> <div class="loop"> <?php
                $reviewtitle = $row["title"];
                $reviewbody = $row["body"];
                $reviewCount += 1;
                echo "<br>", $reviewtitle, "<br>", $reviewbody ,"<br>";
                ?> </div> <?php
        }

    }
    ?>
</div>
<br>


<?php  if(isset($_POST['reviewTextArea']) && isset($_POST['titleTextArea'])){


    $reviewTextArea = validate($_POST['reviewTextArea']);
    $titleTextArea = validate($_POST['titleTextArea']);
    $rating = validate($_POST['rating']);


    if (empty($titleTextArea)){
        echo "Title can't be empty";


    }
    else if (empty($reviewTextArea)){
        echo "Review can't be empty";

    }
    else if($rating == "rate"){
        echo "Please rate the book";

    }
    else{
        $sql = "SELECT MAX(CAST(review_id AS INT)) as maxNum FROM review";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_fetch_assoc($result);

        $max = $num['maxNum'];
        $max = $max + 1;

        $sql = "SELECT G.genre_id, B.book_id FROM genre G, book B WHERE B.title = '$booktitle' AND G.genre_name = '$genrename'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $book_id = $row['book_id'];
        $titleTextArea .= "\t\t- " . $_SESSION['name'] . ":\t Rated: " . $rating;

        $sql = "INSERT INTO review (review_id, title, body) values ('$max', '$titleTextArea', '$reviewTextArea')";
        mysqli_query($conn, $sql);

        $sql = "INSERT INTO has (review_id, book_id) values ('$max', '$book_id')";
        mysqli_query($conn, $sql);


        $reviewTotal = $reviewCount * $bookrating;
        $reviewTotal = $reviewTotal + intval($rating);
        $finalRating = $reviewTotal / ($reviewCount + 1);

        $sql = "UPDATE book SET rating = '$finalRating' WHERE title = '$booktitle'";
        mysqli_query($conn, $sql);

        header("Location: home.php?error=Review successfully submitted");


    }

}

?>


</body>
</html>
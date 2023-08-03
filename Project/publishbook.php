<?php
session_start();
?>
<style>
    /* Style the navigation bar */
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

    /* Style the publish form */
    .publish-form {
        width: 50%;
        margin: 0 auto;
        padding: 20px;
        background-color: #eee;
        border-radius: 5px;
    }

    body {
        padding: 0;
        margin: 0;
    }

    /* Style the form elements */
    .element {
        margin: 20px 0;
    }

    /* Style the publish button */
    .publish-button {
        background-color: deepskyblue;
        border: none;
        color: white;
        padding: 15px 32px;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
    }

    /* Style the error message */
    .error {
        color: red;
        font-weight: bold;
    }

    /* Style the form elements */
    .element {
        margin: 20px 0;
        display: flex;
    }

    /* Style the label element */
    .element label {
        flex: 1;
    }

    /* Style the publish button */
    .publish-button {
        background-color: deepskyblue;
        border: none;
        color: white;
        padding: 15px 32px;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        margin-left: 0;
    }

    .back-button {
        width: 82px;
        height: 10px;
        color: white;
        display: inline-block;
        padding: 0px 6px 2px 4px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: deepskyblue;
        border-radius: 4px;

        transition: all 0.2s ease-in-out;
    }


</style>

<!DOCTYPE html>
<html lang="">
<head>
    <title>HOME PAGE</title>
</head>

<body><!-- Navigation bar -->
<div class="navbar">
    <a href="home.php">HomePage</a>
    <a href="author_search.php">Author Search</a>
    <a href="#">Forum</a>
    <a href="#">Reviews</a>
    <a href="#">Profile</a>
    <a href="index.php">Logout</a>
</div>
<body>

<form action="publishbook.inc.php" method="post" enctype="multipart/form-data">
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <br>
    <div class="publish-text" align="center">
        <h2> You can publish book by giving information below</h2>
    </div>
    <div class="publish-form">
        <div class="element">
            <label>Book Title:</label>
            <br>
            <input type="text" name="bookTitle" placeholder="Enter Book Title">
        </div>
        <div class="element">
            <label>Book Price:</label>
            <br>
            <input type="number" min="1" name="bookPrice" placeholder="Price" step="any"/>
        </div>

        <div class="element">
            <label>Pdf File:</label>
            <br>
            <input type="file" name="file" size="50"/>
        </div>

        <div class="element">
            <label>Select Genre:</label>
            <select name="genre" id="genre">
                <option value="action">Action</option>
                <option value="comedy">Comedy</option>
                <option value="drama">Drama</option>
                <option value="fantasy">Fantasy</option>
                <option value="horror">Horror</option>
                <option value="romance">Romance</option>
            </select>

        </div>

        <div class="element">
            <label> You can publish:</label>
            <button class="publish-button" type="submit"> Publish Book
            </button>
        </div>

        <div class="element">
            <label>Or either go back:</label>
            <button class="publish-button">
                <a class="back-button" href="home.php">Go Back</a>
            </button>
        </div>

        <div class="element">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
        </div>
</form>
</body>
</html>
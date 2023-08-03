<!DOCTYPE html>
<html lang="">
<head>
    <title>REGISTER</title>
    <style>
        body {
            margin-top: 17%;
            font-family: Arial, sans-serif;
            padding: 0;
            background-color: #fff;
        }

        form {
            width: 400px;
            margin: 0 auto;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }

        h2 {
            margin: 0 0 20px 0;
            text-align: center;
        }

        label {
            display: block;
            margin: 0 0 10px 0;
        }

        input[type="text"],
        input[type="password"] {
            margin-bottom: 5px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 8px;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: white;
        }

        button[type="submit"] {
            margin-top: 5px;
            width: 100%;
            border: 0;
            border-radius: 5px;
            padding: 10px;
            background-color: deepskyblue;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            margin-bottom: 5px;
            background-color: deepskyblue;
        }

        .error {
            color: red;
            margin: 0 0 10px 0;
        }

        a {
            display: block;
            margin: 20px 0 0 0;
            text-align: center;
            color: deepskyblue;
            text-decoration: none;
        }
    </style>
</head>
<body>
<form id="register-form" action="register.inc.php" method="post">

    <h2>REGISTER</h2>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <label>Email</label>
    <input type="text" name="email" placeholder="E-mail">

    <label>User Name</label>
    <input type="text" name="uname" placeholder="User Name">

    <label> Password </label>
    <input type="password" name="password" placeholder="Password">

    <label> User Type </label>
    <select name="usertype" id="usertype">
        <option value="0">User Type</option>
        <option value="1">Author</option>
        <option value="2">Reader</option>
    </select>
    <button type="submit"> Register</button>
</form>

<a href="index.php" class="back-link">Go Back</a>
</form>
</body>
</html>

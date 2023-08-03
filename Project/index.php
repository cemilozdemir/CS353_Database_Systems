<!DOCTYPE html>
<html lang="">
<head>
    <title>LOGIN</title>
    <style>
        h1 {
            text-align: center;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 60%;
            margin: 8px 0;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            margin: 8px 0;
            padding: 12px 20px;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: deepskyblue;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .signup-container {
            display: flex;
        }

        .signupbutton {
            width: 100%;
            margin: 0px 0px;
            padding: 10px 10px;
            box-sizing: border-box;
            border: none;
            border-radius: 4px;
            background-color: deepskyblue;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }
        .textClass {
            margin: 20px;
        }
    </style>
</head>
<body>
<form action="login.php" method="post">
    <h1>LOGIN</h1>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <div class="form-container">
        <input type="text" name="email" placeholder="Email"/>
        <input type="password" name="password" placeholder="Password"/>
        <div class="button-container">
            <button title="submit">Login</button>
</form>
<div class="signup-container">
    <p class = "textClass" >Not a member?</p>
    <form action="register.php" method="post">
        <br>
        <button class="signupbutton" type="submit"> Register</button>
    </form>
</div>
</div>
</div>
</body>
</html>
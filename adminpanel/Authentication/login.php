<?php include_once "../../includes/config.php" ?>
<html>

<head>
    <title>Login -Food Order System</title>
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body>
    <div class='login'>
        <h1 class="text-center">Login</h1>
        <br /> <br />
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="success">
                <span><?= $_SESSION['error']; ?></span>
                <span><?php unset($_SESSION['error']); ?></span>

            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="success">
                <span><?= $_SESSION['message']; ?></span>
                <span><?php unset($_SESSION['message']); ?></span>

            </div>
        <?php endif; ?>
        <!-- login form starts here -->
        <form action="" method="POST" class="text-center">
            UserName: <br /> <br />
            <input type="text" name="user_name" placeholder="please enter your username"><br /><br />
            Password: <br /> <br />
            <input type="password" name="password" placeholder="please enter your password"><br />
            <br /> 
            <input type="submit" name="login" value="login" class="btn-primary">

        </form>

        <!-- login form ends here -->

    </div>
</body>

</html>

<?php

//chech if login button is clicked
if (isset($_POST['login'])) {
    //get the dtat from the login form
    $username = mysqli_real_escape_string($connection, $_POST['user_name']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); //problem in this encryption?????
    // sql statment to check whether the username and password exist or not
    $sql = "SELECT `user_name`,`password` FROM admins WHERE `user_name`= '$username'";
    // AND `password`= '$hashed_password'
    //execute the statment
    $result = mysqli_query($connection, $sql);
    // print_r($result);
    // die();
    //check whether statment is executed or not and display a message
    if (mysqli_affected_rows($connection) > 0) {
        //user available and login succeded
        // $_SESSION['success'] = 'You Successfully Logged In';
        $_SESSION['user'] = $username; //check whether user logged in or not and logging out will unset it
        header("location:".SITEURL."adminpanel/");

    }else {
        $_SESSION['error'] = '<div class="error text-center">Failed To Log In</div>';
        header("location:".SITEURL."adminpanel/Authentication/login.php");
    }
}

?>

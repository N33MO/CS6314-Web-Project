<?php
session_start();
$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty(trim($_POST["username"])))
    {
        $username_err = "Please enter username.";
    }
    else
    {
        $username = trim($_POST["username"]);
    }

    if(empty($_POST["password"])){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err))
    {
        $sql = "SELECT AccountID, UserName, Password FROM customer WHERE UserName=?";

        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $mypassword);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $mypassword))
                        {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            header("Location: index.php");

                        }
                        else
                        {
                            $password_err = "Invalid username or password.";
                        }
                    }
                    else
                    {
                        $username_err = "Invalid username or password.";
                        
                    }
                }
                else
                {
                    $sql = "SELECT AccountID, UserName, Password FROM admin WHERE UserName=?";
                    if($stmt = mysqli_prepare($conn, $sql))
                    {
                        mysqli_stmt_bind_param($stmt, "s", $param_username);
                        $param_username = $username;
                        if(mysqli_stmt_execute($stmt))
                        {
                            mysqli_stmt_store_result($stmt);
                            if(mysqli_stmt_num_rows($stmt) == 1)
                            {
                                mysqli_stmt_bind_result($stmt, $id, $username, $mypassword);
                                if(mysqli_stmt_fetch($stmt))
                                {
                                    if(password_verify($password, $mypassword))
                                    {
                                        session_start();
                                        $_SESSION["adminloggedin"] = true;
                                        $_SESSION["loggedin"] = true;
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;
                                        header("Location: index.php");

                                    }
                                    else
                                    {
                                        $password_err = "Invalid username or password.";
                                    }
                                }
                                else
                                {
                                    $username_err = "Invalid username or password.";
                                }
                            }
                            else
                            {
                                mysqli_stmt_close($stmt);
                            }
                        }
                    }
                }
            }
        }
        
    }
    mysqli_close($conn);
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>

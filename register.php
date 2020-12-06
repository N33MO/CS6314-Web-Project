<?php
$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");

$username_err = "";
$password_err = "";
$email_err = "";
$fname_err = "";
$lname_err = "";
$phonenumber_err = "";
$confirm_password_err = "";

$username = "";
$password = "";
$email = "";
$fname = "";
$lname = "";
$phonenumber = "";
$confirm_password = "";


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // input username
    if(empty(trim($_POST['inputUsername'])))
    {
        $username_err = "This field cannot be empty.";
    }
    else
    {
        $sql = "SELECT AccountID FROM customer WHERE UserName=?";
        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST['inputUsername']);
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken.";
                }
                else
                {
                    $username = trim($_POST['inputUsername']);
                }
            }
            else
            {
                // echo $stmt;
                echo "1 Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // input password
    if(empty($_POST['inputPassword']))
    {
        $password_err = "This field cannot be empty.";
    }
    elseif(strlen($_POST['inputPassword']) < 8)
    {
        $password_err = "Password must has atleast 8 characters.";
    }
    // add more validation chack
    else
    {
        $password = $_POST['inputPassword'];
    }

    // Validate confirm password
    if(empty($_POST['confirm_password'])){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = $_POST["confirm_password"];
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    // input email
    if(empty(trim($_POST['inputEmail'])))
    {
        $email_err = "This field cannot be empty.";
    }
    else
    {
        $sql = "SELECT AccountID FROM customer WHERE Email=?";
        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST['inputEmail']);
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $email_err = "This email is already registed";
                }
                else
                {
                    $email = trim($_POST['inputEmail']);
                }
            }
            else
            {
                // echo $stmt;
                echo "2 Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // input first name
    if(empty(trim($_POST['inputFname'])))
    {
        $fname_err = "This field cannot be empty.";
    }
    // add more validation chack
    else
    {
        $fname = trim($_POST['inputFname']);
    }

    // input last name
    if(empty(trim($_POST['inputLname'])))
    {
        $lname_err = "This field cannot be empty.";
    }
    // add more validation chack
    else
    {
        $lname = trim($_POST['inputLname']);
    }

    // input phone number
    if(empty(trim($_POST['inputPhonenumber'])))
    {
        $phonenumber_err = "This field cannot be empty.";
    }
    elseif(strlen(trim($_POST['inputPhonenumber'])) != 10)
    {
        $phonenumber_err = "Please check your phone number again";
    }
    // add more validation chack
    else
    {
        $phonenumber = trim($_POST['inputPhonenumber']);
    }

    if(empty($username_err) && empty($password_err) && empty($email_err) && empty($fname_err) && empty($lname_err) && empty($phonenumber_err))
    {
        $sql = "INSERT INTO `admin` (`Fname`, `Lname`, `UserName`, `Password`, `Phone`, `Email`) VALUES (?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "ssssss", $param_fname, $param_lname, $param_username, $param_hash_password, $param_phonenumber, $param_email);
            $param_fname = $fname;
            $param_lname = $lname;
            $param_username = $username;
            $param_hash_password = password_hash($password, PASSWORD_DEFAULT);
            $param_phonenumber = $phonenumber;
            $param_email = $email;

            if(mysqli_stmt_execute($stmt))
            {
                header("Location: login.php");
            }
            else
            {
                // echo $stmt;
                echo "3 Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="inputUsername" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="inputPassword" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="inputEmail" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                <label>First name</label>
                <input type="text" name="inputFname" class="form-control" value="<?php echo $fname; ?>">
                <span class="help-block"><?php echo $fname_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                <label>Last name</label>
                <input type="text" name="inputLname" class="form-control" value="<?php echo $lname; ?>">
                <span class="help-block"><?php echo $lname_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($phonenumber_err)) ? 'has-error' : ''; ?>">
                <label>Phone number</label>
                <input type="text" name="inputPhonenumber" class="form-control" value="<?php echo $phonenumber; ?>">
                <span class="help-block"><?php echo $phonenumber_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
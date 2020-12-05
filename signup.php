<?php
session_start();
$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");

if(!empty($_POST))
{
    $email = trim($_POST['inputEmail']);
    $password = trim($_POST['inputPassword']);
    $fname = trim($_POST['inputFname']);
    $lname = trim($_POST['inputLname']);
    $username = trim($_POST['inputUsername']);
    $phonenumber = trim($_POST['inputPhonenumber']);
    
    $hash_password = password_hash($password, PASSWORD_ARGON2I);
    $res = mysqli_query($conn, "SELECT * FROM customer WHERE Email=$email");
    $nr = mysqli_num_rows($res);
    if($nr == 0)
    {
        // add a new customer
        $sql = "INSERT INTO `customer` (`Fname`, `Lname`, `UserName`, `Password`, `Phone`, `Email`) VALUES ('$fname', '$lname', '$username', '$hash_password', '$phonenumber', '$email')";

        if ($conn->query($sql) === TRUE) 
        {
            echo "New record created successfully";
        } else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else
    {
        // exist username turn red
        echo "the user in already exist";
    }    

}
mysqli_close($conn);
echo '<script>';
echo 'console.log(log here)';
echo '</script>';
// header("Location: login.html");
?>
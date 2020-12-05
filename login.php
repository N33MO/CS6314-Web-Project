<?php
session_start();
$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");

if(isset($_POST['login']))
{
    $email = trim($_POST['inputEmail']);
    $password = $_POST['inputPassword'];
    
    $hasil = $conn->prepare("SELECT Password FROM customer WHERE Email=?");
    $hasil->bind_param("d", $email);
    $hasil->execute();
    $hasil->bind_result($mypassword);
    $hasil->fetch();
    if(password_verify($password, $mypassword))
    {
        echo "password is correct";
        // $_SESSION['id'] = $id;
        // $_SESSION['user'] = $username;
        header("Location: customerpage.php");

    }
    else
    {
        echo "invalid email or password";
    }
}

?>
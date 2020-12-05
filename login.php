<?php
session_start();
$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");

if(isset($_POST['login']))
{
    $email = trim($_POST['inputEmail']);
    $password = trim($_POST['inputPassword']);
    $md_password = password_hash('rasmuslerdorf', PASSWORD_ARGON2I);
    $hasil = $conn->prepare("SELECT * FROM customer WHERE Email=?");
    $hasil->bind_param("d", $email);
    $hasil->execute();
    $hasil->bind_result($id, $fname, $lname, $dob, $ssn, $username, $mypassword, $mypayment, $mymailaddress, $mybilladdress, $myphone, $myemail);
    $hasil->fetch();
    if($mypassword == $md_password)
    {
        echo "password is correct";
        $_SESSION['id'] = $id;
        $_SESSION['user'] = $username;

    }
    else
    {
        echo "invalid email or password";
    }
}
?>
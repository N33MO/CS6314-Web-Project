<?php
session_start();

$conn = mysqli_connect("localhost", "root", "password") or die("cannot connect to database");
mysqli_select_db($conn, "databasename") or die("cannot find database");

if(isset($_POST['login']))
{
    $email = trim($_POST['inputEmail']);
    $password = trim($_POST['inputPassword']);
    $md_password = md5($password);
    $hasil = $mysqli->prepare("SELECT * FROM customer WHERE Email=?");
    $hasil->bind_para("d", $email);
    $hasil->execute();
    $hasil->bind_result($id, $fname, $lname, $dob, $ssn, $username, $mypassword, $mypayment, $mymailaddress, $mybilladdress, $myphone, $myemail);
    $hasil->fetch();
    if($mypassword === $md_password)
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
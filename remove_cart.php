<?php 
    if (!isset($_SESSION)) {
        session_start();
    }
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        $account_id = $_SESSION["id"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if ($_GET["pid"]) {
            $pid = $_GET['pid'];
        } else {
            header("Location: cart.php");
        }
    }

    $ini = parse_ini_file("info.ini");
    $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");
    if (mysqli_connect_errno($conn)) {
        die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
    }
    $sql = "DELETE FROM cart_own_product WHERE AccountID=$account_id AND ProductID=$pid";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo '<script>alert("Cannot remove item from cart!")</script>'; 
    }
    header("Location: cart.php");
?>
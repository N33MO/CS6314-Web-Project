<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $account_id = $_SESSION["id"];
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["pid"]) {
        $pid = $_GET['pid'];

        $ini = parse_ini_file("info.ini");
        $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");
        if (mysqli_connect_errno($conn)) {
            die('Connect Error (' . $conn->connect_errno . ') '
                . $conn->connect_error);
        }
        $sql = "INSERT INTO cart_own_product (`AccountID`,`ProductID`,`Num`) VALUES($account_id, $pid, 1) ON DUPLICATE KEY UPDATE Num = Num+1";
        $result = mysqli_query($conn, $sql);
    }
}

header("Location: detail.php?pid=$pid");

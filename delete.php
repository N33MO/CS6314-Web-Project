<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if ($_GET["pid"]) {
        $pid = $_GET['pid'];
    } else {
        header("Location: index.php");
    }
}

$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]);

if (mysqli_connect_errno($conn)) {
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}

$sql = "UPDATE `product` SET `Removed`='1' WHERE `ProductID`='".$pid."'";
if(mysqli_query($conn, $sql) === true)
{
    header("Location: index.php");
}
else
{
    echo "Cannot delete this product.";
}

?>

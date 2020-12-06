<?php
    if(isset($_POST["newImage"]) && isset($_POST["newName"]) && isset($_POST["newDescription"]) &&
    isset($_POST["newNum"]) && isset($_POST["newCategory"]) && isset($_POST["newPrice"]) && isset($_POST["id"]))
    {
        $sql = "UPDATE `product` SET `Image`=".$_POST["newImage"].", `Name`=".$_POST["newName"].
        ", `Description=`".$_POST["newDescription"].", `Num`=".$_POST["newNum"].", Category=".
        $_POST["newCategory"].", `Price=`".$_POST["newPrice"]." WHERE ProductID=".$_POST["id"];
        $ini = parse_ini_file("info.ini");
        $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");
        if (mysqli_connect_errno($conn)) {
            die('Connect Error (' . $conn->connect_errno . ') '
                . $conn->connect_error);
        }
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
    }
    header("Location: update.php?pid=".$_POST["id"]);
?>

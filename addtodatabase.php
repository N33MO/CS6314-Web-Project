<?php
    if(isset($_POST["newImage"]) && isset($_POST["newName"]) && isset($_POST["newDescription"]) &&
    isset($_POST["newNum"]) && isset($_POST["newCategory"]) && isset($_POST["newPrice"]))
    {
        $ini = parse_ini_file("info.ini");
    
        $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]);
        $sql = "INSERT INTO `product` (`Name`, `Price`, `Num`, `Category`, `Description`, `Image` , `Removed`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "sssssss", $param_name, $param_price, $param_num, $param_category, $param_Description, $param_image, $param_removed);
            $param_name = $_POST["newName"];
            $param_price = $_POST["newPrice"];
            $param_num = $_POST["newNum"];
            $param_category = $_POST["newCategory"];
            $param_Description = $_POST["newDescription"];
            $param_image = $_POST["newImage"];
            $param_removed = '0';

            if(mysqli_stmt_execute($stmt))
            {
                header("Location: index.php");
            }
            else
            {
                echo "failed to add new item, stmt";
            }
            mysqli_stmt_close($stmt);
        }
        else
        {
            echo "failed to add new item, out stmt";
        }
    $conn->close();
    }
    else
    {
        echo "failed to add new item, outside everything";
    }
?>
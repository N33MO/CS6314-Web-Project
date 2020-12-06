<!DOCTYPE html>
<html lang="en">
<?php include "partial/header.php"; ?>
<main>
    <div class="container">
        <?php
        $now_date = date('Y-m-d');
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            $account_id = $_SESSION["id"];
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ini = parse_ini_file("info.ini");
            $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");
            if (mysqli_connect_errno($conn)) {
                die('Connect Error (' . $conn->connect_errno . ') '
                    . $conn->connect_error);
            }
            $sql = 'SELECT MAX(`OrderID`) AS max_order_id FROM purchased_order';
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_object($result);
            $order_id = number_format($row->max_order_id) + 1;

            $sql = "INSERT INTO 
                    purchased_order (`OrderID`,`AccountID`,`PurchaseDate`, `TotalPrice`) 
                    VALUES($order_id, $account_id, date('$now_date'), 0)";
            $result = mysqli_query($conn, $sql);
            if ($result == false) {
                // echo "Failed to place order.";
                die('Failed to place order. ' . mysqli_error($conn));
            } else {
                $sql = "SELECT Name, Price, cart_own_product.Num, product.ProductID  FROM cart_own_product, product WHERE cart_own_product.AccountID=$account_id AND product.ProductID = cart_own_product.ProductID";
                $result = mysqli_query($conn, $sql);
                if ($result != null && $result->num_rows > 0) {
                    $count = 1;
                    $total_price = 0;
                    while ($row = $result->fetch_assoc()) {
                        $pid = $row['ProductID'];
                        $name = $row['Name'];
                        $price = $row['Price'];
                        $num = $row['Num'];
                        $sql = "INSERT INTO 
                        order_detail (`OrderID`,`ProductID`,`Name`,`PurchasedPrice`,`Num`) 
                        VALUES($order_id, $pid, '$name', $price, $num)";
                        $insert_result = mysqli_query($conn, $sql);
                        if ($insert_result == false) {
                            // echo "Failed to place order.";
                            die('Failed to insert order_detail ' . mysqli_error($conn));
                        }
                        $total_price += $row["Price"];
                    }
                }
                $sql = "UPDATE purchased_order SET TotalPrice=$total_price WHERE OrderID=$order_id";
                $result = mysqli_query($conn, $sql);
                if ($result == false) {
                    // echo "Failed to update total price.";
                    die('Failed to update total price. ' . mysqli_error($conn));
                }
                $sql = "DELETE FROM cart_own_product WHERE AccountID=$account_id";
                $result = mysqli_query($conn, $sql);
                if ($result == false) {
                    // echo "Failed to clear shopping cart.";
                    die('Failed to clear shopping cart. ' . mysqli_error($conn));
                }else{
                    echo "<p>Your order has been placed!</p>";
                }
            }
            $conn->close();
        }
        ?>
    </div>
</main>

<body>
    <?php include "partial/navbar.php"; ?>
    <footer class="container">
        <hr>
        <p>Web Final Project - 2020 Fall - CS6314.002</p>
    </footer>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
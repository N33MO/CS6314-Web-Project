<?php

if (!isset($_SESSION)) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include "partial/header.php";?>

<body>
<?php include "partial/navbar.php";?>

    <main role="main">
        <div class="container">
            <?php
            if (!isset($_SESSION)) {
                session_start();
            }
            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                $account_id = $_SESSION["id"];
            }
            $ini = parse_ini_file("info.ini");
            $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");
            if (mysqli_connect_errno($conn)) {
                die('Connect Error (' . $conn->connect_errno . ') '
                    . $conn->connect_error);
            }
            $sql = "SELECT Name, Price, cart_own_product.Num, product.ProductID  FROM cart_own_product, product WHERE cart_own_product.AccountID=$account_id AND product.ProductID = cart_own_product.ProductID";
            $result = mysqli_query($conn, $sql);
            if ($result != null && $result -> num_rows>0) {
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">price</th>
                            <th scope="col">number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $total_price = 0;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><th>" . $count . "</th>";
                            echo "<td><a href=detail.php?pid=" . $row["ProductID"] . ">" . $row["Name"] . "</a></td>";
                            echo "<td>" . $row["Price"] . "</td>";
                            echo "<td>" . $row["Num"] .  "</td>";
                            echo "</tr>" . PHP_EOL;
                            $count += 1;
                            $total_price += $row["Price"];
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <p>Total price: <?php echo $total_price ?></p>
                    </div>
                    <div class="col-md-3">
                        <form action="place_order.php" method="POST">
                            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="check out"/>
                        </form>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <p>Your shopping cart is empty.</p>
            <?php
            }
            $conn->close();
            ?>
        </div>
        </div> <!-- /main -->
    </main>

    <footer class="container">

        <hr>
        <p>Web Final Project - 2020 Fall - CS6314.002</p>
    </footer>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
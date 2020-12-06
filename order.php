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
            <h2>Orders</h2>
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
            $sql = "SELECT OrderID, PurchaseDate, TotalPrice FROM purchased_order WHERE purchased_order.AccountID=$account_id";
            $result = mysqli_query($conn, $sql);
            if ($result != null && $result -> num_rows>0) {
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">OrderID</th>
                            <th scope="col">PurchaseDate</th>
                            <th scope="col">TotalPrice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><th>" . $count . "</th>";
                            echo "<td><a href=order_detail.php?oid=" . $row["OrderID"] . ">" . $row["OrderID"] . "</a></td>";
                            echo "<td>" . $row["PurchaseDate"] . "</td>";
                            echo "<td>" . $row["TotalPrice"] .  "</td>";
                            echo "</tr>" . PHP_EOL;
                            $count += 1;
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <p>Your have no order.</p>
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
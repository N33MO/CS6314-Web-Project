<!DOCTYPE html>
<html lang="en">
<?php include "partial/header.php"; ?>
<main>
    <div class="container">
        <?php
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
            $sql = "";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error.";
            } else {
                echo "Records added successfully.";
            }
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
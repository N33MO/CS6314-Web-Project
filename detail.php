<!DOCTYPE html>
<html lang="en">
<?php include "partial/header.php"; ?>
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
$sql = "SELECT * FROM product WHERE ProductID=$pid";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    $row = $result->fetch_assoc();
?>

    <body>
        <?php include "partial/navbar.php"; ?>


        <main>
            <div class="container">
                <h1>Detail Page</h1>
                <div class="row justify-content-center" id="coffee-row">
                    <div class="col-md-4">
                        <img class="item-img" src="img/<?php echo $row["Image"]; ?>" alt="<?php echo $row["Image"]; ?>">
                    </div>
                    <div class="col-md-4">
                        <h2><?php echo $row["Name"]; ?></h2>
                        <p><?php echo $row["Description"]; ?></p>
                        <p><a class="btn btn-secondary" href="add_cart.php?pid=<?php echo $pid; ?>">Add to Cart</a></p>
                    </div>
                </div>
            </div>
        </main>
        <footer class="container">
            <hr>
            <p>Web Final Project - 2020 Fall - CS6314.002</p>
        </footer>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
<?php
}
?>

</html>
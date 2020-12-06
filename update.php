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
                <h1>Update item</h1>
                <div class="row justify-content-center" id="coffee-row">
                    <form action="updatedatabase.php" method="post" class="col-md-4">
                        <textarea readonly name="id"><?php echo $pid?></textarea>
                        <img class="item-img" src="img/<?php echo $row["Image"]; ?>" alt="<?php echo $row["Image"]; ?>">
                        <textarea name="newImage"><?php echo $row["Image"]; ?></textarea>
                        <h2><?php echo $row["Name"]; ?></h2>
                        <textarea name="newName"><?php echo $row["Name"]; ?></textarea>
                        <p><?php echo $row["Description"]; ?></p>
                        <textarea name="newDescription"><?php echo $row["Description"]; ?></textarea>
                        <p><?php echo $row["Num"]; ?></p>
                        <textarea name="newNum"><?php echo $row["Description"]; ?></textarea>
                        <p><?php echo $row["Category"]; ?></p>
                        <label for="newCategory">Category</label>
                        <select id="newCategory" name="newCategory">
                            <option value="*">Any</option>
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select>
                        <p><?php echo $row["Price"]; ?></p>
                        <textarea name="newPrice"><?php echo $row["Price"]; ?></textarea>
                        <input type="submit" value="Submit">

                    </form>
                </div>
                <p><a class="btn btn-secondary" href="index.php">Back</a></p>
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
$conn->close();
}
?>

</html>
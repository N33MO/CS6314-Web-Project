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
                        <label for="id">Product ID (not editable): </label>
                        <input readonly name="id" id="id" value=<?php echo $pid?>>

                        <label for="newImage">Product image file name: </label>
                        <img class="item-img" src="img/<?php echo $row["Image"]; ?>" alt="<?php echo $row["Image"]; ?>">
                        <input name="newImage" id="newImage" value=<?php echo $row["Image"]; ?>>

                        <label for="newName">Product name: </label>
                        <p><?php echo $row["Name"]; ?></p>
                        <input name="newName" id="newName" value=<?php echo $row["Name"]; ?>>

                        <label for="newDescription">Product description: </label>
                        <p><?php echo $row["Description"]; ?></p>
                        <textarea name="newDescription" id="newDescription"><?php echo $row["Description"]; ?></textarea>
                        
                        <label for="newNum">Product current amount: </label>
                        <p><?php echo $row["Num"]; ?></p>
                        <input type="number" min="0" step="1" name="newNum" id="newNum" value=<?php echo $row["Num"]; ?>>
                        
                        <label for="newCategory">Product category: </label>
                        <p><?php echo $row["Category"]; ?></p>                        
                        <select id="newCategory" name="newCategory">
                            <option value="*">Any</option>
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select>

                        <label for="newPrice">Product price: </label>
                        <p><?php echo $row["Price"]; ?></p>
                        <input type="number" name="newPrice" id="newPrice"value=<?php echo $row["Price"]; ?>>
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
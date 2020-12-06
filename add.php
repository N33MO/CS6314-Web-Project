<!DOCTYPE html>
<html lang="en">
<?php include "partial/header.php"; ?>


<?php
    if(isset($_POST["newImage"]) && isset($_POST["newName"]) && isset($_POST["newDescription"]) &&
    isset($_POST["newNum"]) && isset($_POST["newCategory"]) && isset($_POST["newPrice"]))
    {
        $sql = "INSERT INTO `product` (`Name`, `Price`, `Num`, `Category`, `Description`, `Image`) VALUES (?, ?, ?, ?, ?, ?)";
        if($stmt = mysqli_prepare($conn, $sql))
        {
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_price, $param_num, $param_category, $param_Description, $param_image);
            $param_name = $_POST["newName"];
            $param_price = $_POST["newPrice"];
            $param_num = $_POST["newNum"];
            $param_category = $_POST["newCategory"];
            $param_Description = $_POST["newDescription"];
            $param_image = $_POST["newImage"];

            if(mysqli_stmt_execute($stmt))
            {
                header("Location: login.php");
            }
            else
            {
                // echo $stmt;
                echo "failed to add new item";
            }
            mysqli_stmt_close($stmt);
        }
    }
?>


    <body>
        <?php include "partial/navbar.php"; ?>
        <main>
            <div class="container">
                <h1>Update item</h1>
                <div class="row justify-content-center" id="coffee-row">
                    <form action="" method="post" class="col-md-4">
                        
                        <textarea name="newImage">New item image</textarea>
                        
                        <textarea name="newName">New item name</textarea>
                        
                        <textarea name="newDescription">New item description</textarea>
                        
                        <textarea name="newNum">New item total amount</textarea>
                        
                        <label for="newCategory">Category</label>
                        <select id="newCategory" name="newCategory">
                            <option value="*">Any</option>
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select>
                        
                        <textarea name="newPrice">Price</textarea>
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
</html>
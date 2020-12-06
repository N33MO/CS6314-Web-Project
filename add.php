<!DOCTYPE html>
<html lang="en">
    <?php include "partial/header.php"; ?>


    <body>
        <?php include "partial/navbar.php"; ?>


        <main>
            <div class="container">
                <h1>Update item</h1>
                <div class="row justify-content-center" id="coffee-row">
                    <form action="addtodatabase.php" method="post" class="col-md-4">
                        <label for="newImage">Product image file name: </label>
                        <input name="newImage" id="newImage">

                        <label for="newName">Product name: </label>
                        <input name="newName" id="newName">

                        <label for="newDescription">Product description: </label>
                        <textarea name="newDescription" id="newDescription"></textarea>
                        
                        <label for="newNum">Product current amount: </label>
                        <input type="number" min="0" step="1" name="newNum" id="newNum">
                        
                        <label for="newCategory">Product category: </label>                    
                        <select id="newCategory" name="newCategory">
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select>

                        <label for="newPrice">Product price: </label>
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


</html>
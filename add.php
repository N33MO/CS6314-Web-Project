<!DOCTYPE html>
<html lang="en">
<?php include "partial/header.php"; ?>


<body>
    <?php include "partial/navbar.php"; ?>


    <main>
        <div class="container">
            <h1>Add item</h1>
            <div class="row justify-content-center">
                <form action="addtodatabase.php" method="post" class="col-md-4">
                    <div class="form-group">
                        <label for="newImage">Product image file name: </label>
                        <input name="newImage" class="form-control" id="newImage">
                    </div>

                    <div class="form-group">
                        <label for="newName">Product name: </label>
                        <input name="newName" class="form-control" id="newName">
                    </div>

                    <div class="form-group">
                        <label for="newDescription">Product description: </label>
                        <textarea name="newDescription" class="form-control" id="newDescription"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="newNum">Product current amount: </label>
                        <input type="number" min="0" step="1" name="newNum" class="form-control" id="newNum">
                    </div>
                    <div class="form-group">
                        <label for="newCategory">Product category: </label>
                        <select id="newCategory" class="form-control" name="newCategory">
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="newPrice">Product price: </label>
                        <input type="number" min="0" max="999" name="newPrice" class="form-control" id="newPrice">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit">

                </form>
            </div>

            <div class="row justify-content-start">
                <div class="col-md-4">
                    <a class="btn btn-secondary" href="index.php">Back</a>
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


</html>
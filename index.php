<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "partial/header.php"; ?>

<body>
    <?php include "partial/navbar.php"; ?>

    <main role="main">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Coffee & Tea Distributor</h1>
                <p>Coffee & Tea Distributor description. Coffee & Tea Distributor description. Coffee & Tea Distributor
                    description. Coffee & Tea Distributor description. Coffee & Tea Distributor description. Coffee &
                    Tea Distributor description. Coffee & Tea Distributor description. </p>
                <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
                <div class="container">
                    <!-- <form action="search.php" method="post" class="form-inline my-2 my-lg-0"> -->
                    <form action="" method="post" class="form-inline my-2 my-lg-0">
                        <div class="form-group"></div>
                        <label for="category">Category</label>
                        <select id="category" class="form-control ml-sm-2" name="category">
                            <option value="*">Any</option>
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select>
                        <input class="form-control  ml-sm-2" type="text" name="search" placeholder="Search for a product..." aria-label="Search">
                        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                        <input type="submit" class="btn btn-primary ml-sm-2" value="Search">
                    </form>

                </div>
            </div>
        </div>

        <div class="container">
            <?php

            $paginglist = "";
            if (isset($_GET["pageno"])) {
                $pageno = $_GET["pageno"];
            } else {
                $pageno = 1;
            }
            include "partial/products.php";
            ?>

            <hr>

        </div> <!-- /container -->


        <div style="text-align: center;margin: auto;">
            <ul class="pagination" style="justify-content: center;">
                <li><a href="?pageno=1">First</a></li>&nbsp|&nbsp
                <li class="<?php if ($pageno <= 1) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno <= 1) {
                                    echo '#';
                                } else {
                                    echo "?pageno=" . ($pageno - 1);
                                } ?>">Prev</a>
                </li>
                <?php
                echo $paginglist;
                ?>
                <li class="<?php if ($pageno >= $total_pages) {
                                echo 'disabled';
                            } ?>">
                    <a href="<?php if ($pageno >= $total_pages) {
                                    echo '#';
                                } else {
                                    echo "?pageno=" . ($pageno + 1);
                                } ?>">Next</a>
                </li>&nbsp|&nbsp
                <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </div>


    </main>

    <footer class="container">
        <p>Web Final Project - 2020 Fall - CS6314.002</p>
    </footer>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php include "partial/header.php";?>
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
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="*">Any</option>
                            <option value="coffee">Coffee</option>
                            <option value="tea">Tea</option>
                        </select>
                        <br>
                        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search for a product..." aria-label="Search">
                        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                        <input type="submit" value="Search">
                    </form>

                </div>
            </div>
        </div>

        <div class="container">
            <?php
            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 10;
            $offset = ($pageno - 1) * $no_of_records_per_page;

            $ini = parse_ini_file("info.ini");
            $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");

            $output = "";
            $output = "<div class='row' id='products'>";
            if (isset($_POST['category'])) {
                $category = $_POST['category'];
            }

            if (isset($_POST['search'])) {
                $total_pages_sql = "SELECT COUNT(*) FROM product WHERE ";
                $sql = "SELECT * FROM product WHERE ";
                $s = "";

                $search_query = $_POST['search'];
                if ($search_query != "") {
                    $search_query = preg_replace("#[^0-9a-z]#i", "", $search_query);
                    $s .= "name LIKE '%$search_query%' AND ";
                }

                if ($category != "*") {
                    $s .= "category='$category'";
                } else {
                    $s .= "1";
                }
                $total_pages_sql .= $s;
                $sql .= $s;

                // echo $sql;
                $result = mysqli_query($conn, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $search_result = mysqli_query($conn, $sql) or die("cannot search");
                $r = mysqli_num_rows($search_result);
            } else {
                $total_pages_sql = "SELECT COUNT(*) FROM product";
                $sql = "SELECT * FROM product";

                $result = mysqli_query($conn, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $search_result = mysqli_query($conn, $sql) or die("cannot search");
                $r = mysqli_num_rows($search_result);
            }
            if ($r == 0) {
                $output = "<p>There was no products</p>";
            } else {
                while ($row = mysqli_fetch_array($search_result)) {
                    $ProductID = $row['ProductID'];
                    $Name = $row['Name'];
                    $Price = $row['Price'];
                    $Description = $row['Description'];
                    $Image = $row['Image'];
                    $Num = $row['Num'];
                    $output .= "<div class='col-md-4'>";
                    $output .= "<h2>" . $Name . "</h2>";
                    $output .= "<img class='item-img' src='img/" . $Image . "' alt='" . $Name . "'>";
                    $output .= "<p>" . $Description . "</p>";
                    $output .= "<p><a class='btn btn-secondary' href='./detail.php?pid=" . $ProductID . "' role='button'>View details &raquo;</a></p>
                        </div>";
                }
            }

            $output .= "</div>";
            mysqli_close($conn);
            echo $output;


            ?>

            <hr>

        </div> <!-- /container -->

        <ul class="pagination">
            <li><a href="?pageno=1">First</a></li>
            <li class="<?php if ($pageno <= 1) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno <= 1) {
                                echo '#';
                            } else {
                                echo "?pageno=" . ($pageno - 1);
                            } ?>">Prev</a>
            </li>
            <li class="<?php if ($pageno >= $total_pages) {
                            echo 'disabled';
                        } ?>">
                <a href="<?php if ($pageno >= $total_pages) {
                                echo '#';
                            } else {
                                echo "?pageno=" . ($pageno + 1);
                            } ?>">Next</a>
            </li>
            <li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>

    </main>

    <footer class="container">
        <p>Web Final Project - 2020 Fall - CS6314.002</p>
    </footer>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>

</html>
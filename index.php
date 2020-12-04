<?php

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

$conn = mysqli_connect("localhost", "root", "password") or die("cannot connect to database");
mysqli_select_db($conn, "databasename") or die("cannot find database");



$output = '';
if(isset($_POST['search']))
{
    $total_pages_sql = "SELECT COUNT(*) FROM product";
    $result = mysqli_query($conn,$total_pages_sql);
    $total_rows = mysqli_fetch_array($result)[0];
    $total_pages = ceil($total_rows / $no_of_records_per_page);

    $search_query = $_POST['search'];
    $search_query = preg_replace("#[^0-9a-z]#i", "", $search_query);

    $search_result = mysqli_query($conn, "SELECT * FROM product WHERE name LIKE '%$search_query%'") or die("cannot search");
    $r = mysqli_num_rows($result);
    if($r == 0)
    {
        $output = 'There was no search results';
    }
    else
    {
        while($row = mysqli_fetch_array($search_result))
        {
            $ProductID = $row['ProductID'];
            $Name = $row['Name'];
            $Price = $row['Price'];
            $Description = $row['Description'];
            $Image = $row['Image'];
            $ExpirationDate = $row['ExpirationDate'];
            $Num = $row['Num'];
            $output .= '<div>'.$ProductID.' '.$Name.' '.$Price.'</div>';
        }
    }

}
mysqli_close($conn);


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Coffee & Tea Distributor">
        <meta name="keywords" content="Web Project, Coffee & Tea Distributor">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <link href="css/index.css" rel="stylesheet">
        <script src="js/index.js"></script>

        <title>Web Final Project</title>
        <style>
            body {
                padding-top: 3.5rem;
            }
            
            .item-img {
                float: left;
                width: 200px;
                padding-right: 1rem;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Coffee & Tea</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#coffee-row">Coffee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tea-row">Tea</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->
                    <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> -->
                </ul>
                <a class="btn btn-outline-success my-2 my-sm-0" href="login.html">Login</a>
            </div>
        </nav>

        <main role="main">
            <!-- Main jumbotron for a primary marketing message or call to action -->
            <div class="jumbotron">
                <div class="container">
                    <h1 class="display-3">Coffee & Tea Distributor</h1>
                    <p>Coffee & Tea Distributor description. Coffee & Tea Distributor description. Coffee & Tea Distributor description. Coffee & Tea Distributor description. Coffee & Tea Distributor description. Coffee & Tea Distributor description. Coffee
                        & Tea Distributor description. </p>
                    <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
                    <div class="container">
                        <form action="index.php" method="post" class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search for a product..." aria-label="Search">
                            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
                            <input type="submit" value="Search">
                        </form>
                    </div>
                </div>
            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row" id="coffee-row">
                    <div class="col-md-4">
                        <h2>Coffee#1</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio
                            dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Coffee#2</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio
                            dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Coffee#3</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
                            sit amet risus.</p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Coffee#4</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio
                            dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Coffee#5</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio
                            dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>
                <div class="row" id="tea-row">
                    <div class="col-md-4">
                        <h2>Tea#1</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio
                            dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Tea#2</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio
                            dui. </p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Tea#3</h2>
                        <img class="item-img" src="img/me.jpg" alt="me">
                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
                            sit amet risus.</p>
                        <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                    </div>
                </div>

                <hr>

            </div>
            <!-- /container -->

        </main>

        <footer class="container">
            <p>Web Final Project - 2020 Fall - CS6314.002</p>
        </footer>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>

    </html>
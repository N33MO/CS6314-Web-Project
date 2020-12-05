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
            /* float: left; */
            max-width: 300px;
            padding-right: 1rem;
        }
    </style>
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pid = $_GET['pid'];
}
// echo "pid: $pid";

$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"]);
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
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="#">Coffee & Tea</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#coffee-row">Coffee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#tea-row">Tea</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#">About</a>
                    </li>
                </ul>
                <a class="btn btn-outline-success my-2 my-sm-0" href="login.html">Login</a>
            </div>
        </nav>

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
                        <p><a class="btn btn-secondary" href="#" role="button">Add to Cart</a></p>
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
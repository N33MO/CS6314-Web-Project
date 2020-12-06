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
            max-width: 100%;
            /* width: 200px; */
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

    <main role="main">
        <div class="container">
            <?php
            $account_id = 1;
            $ini = parse_ini_file("info.ini");
            $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");
            if (mysqli_connect_errno($conn)) {
                die('Connect Error (' . $conn->connect_errno . ') '
                    . $conn->connect_error);
            }
            $sql = "SELECT Name, Price, cart_own_product.Num, product.ProductID  FROM cart_own_product, product WHERE cart_own_product.AccountID=$account_id AND product.ProductID = cart_own_product.ProductID";
            $result = mysqli_query($conn, $sql);
            if ($result != null) {
            ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">price</th>
                            <th scope="col">number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $total_price = 0;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><th>" . $count . "</th>";
                            echo "<td><a href=detail.php?pid=" . $row["ProductID"] . ">" . $row["Name"] . "</a></td>";
                            echo "<td>" . $row["Price"] . "</td>";
                            echo "<td>" . $row["Num"] .  "</td>";
                            echo "</tr>" . PHP_EOL;
                            $count += 1;
                            $total_price += $row["Price"];
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row justify-content-between">
                    <div class="col-md-3">
                        <p>Total price: <?php echo $total_price ?></p>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">check out</button>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <p>Your shopping cart is empty.</p>
            <?php
            }
            $conn->close();
            ?>
        </div>
        </div> <!-- /main -->
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
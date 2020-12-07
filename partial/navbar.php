<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-dark">
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
        </ul>
        <?php
        // Check if the user is logged in, if not then show login button
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) 
        {
            echo "<a class='btn btn-outline-success my-2 my-sm-0' href='login.php'>Login</a>";
        } 
        elseif(isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] === true)
        {
            $s = "<span class='text-white mr-2'>hello, admin " . htmlspecialchars($_SESSION["username"])."</span>";
            $s .= "<a class='btn btn-outline-success my-2 my-sm-0' href='logout.php'>Logout</a>";
            echo $s;
        }
        else 
        {
            $s = "<span class='text-white mr-2'>hello," . htmlspecialchars($_SESSION["username"])."</span>";
            $s .= "<a class='btn btn-outline-success my-2 my-sm-0' href='order.php'>Orders</a>";
            $s .= "<a class='btn btn-outline-success my-2 my-sm-0' href='cart.php'>Cart</a>";
            $s .= "<a class='btn btn-outline-success my-2 my-sm-0' href='logout.php'>Logout</a>";
            echo $s;
        }
        ?>
    </div>
</nav>
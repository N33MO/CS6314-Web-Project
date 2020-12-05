<?php

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;

// $conn = mysqli_connect("localhost", "root", "password") or die("cannot connect to database");
// mysqli_select_db($conn, "databasename") or die("cannot find database");

$user = 'root';
$password = 'root'; //To be completed if you have set a password to root
$database = 'project'; //To be completed to connect to a database. The database must exist.
$port = "8889"; //Default must be NULL to use default port
$conn = new mysqli('localhost', $user, $password, $database, $port);


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
// echo $output;

mysqli_close($conn);


?>

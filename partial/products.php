<?php
    session_start();
    if (isset($_GET['pageno'])) {
        $pageno = $_GET['pageno'];
    } else {
        $pageno = 1;
    }
    $no_of_records_per_page = 6;
    $offset = ($pageno - 1) * $no_of_records_per_page;

    $ini = parse_ini_file("info.ini");
    $conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"], $ini["portid"]) or die("cannot connect to database");
        

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) // guest interface
    {     
        $output = "";
        $output = "<div class='row' id='products'>";
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }
        
        if (isset($_POST['search'])) {
            $total_pages_sql = "SELECT COUNT(*) FROM product WHERE Removed<>'1' AND ";
            $sql = "SELECT * FROM product WHERE Removed<>'1' AND ";
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

            $sql .= " LIMIT ".$offset." , ".$no_of_records_per_page;
        
            // echo $sql;
            $result = mysqli_query($conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
        
            $search_result = mysqli_query($conn, $sql) or die("cannot search");
            $r = mysqli_num_rows($search_result);
        } else {
            $total_pages_sql = "SELECT COUNT(*) FROM product WHERE Removed<>'1'";
            $sql = "SELECT * FROM product WHERE Removed<>'1' LIMIT ".$offset." , ".$no_of_records_per_page;
        
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
    } 
    elseif(isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] === true) // admin interface
    {
        $output = "<div><a class='btn btn-secondary' href='./add.php' role='button'>Add new item &raquo;</a></div>";

        $output .= "<div class='row' id='products'>";
        // $output .= "<p><a class='btn btn-secondary' href='./add.php' role='button'>Add new item &raquo;</a></p>";
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }
        
        if (isset($_POST['search'])) {
            $total_pages_sql = "SELECT COUNT(*) FROM product WHERE Removed<>'1' AND ";
            $sql = "SELECT * FROM product WHERE Removed<>'1' AND ";
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

            $sql .= " LIMIT ".$offset." , ".$no_of_records_per_page;
        
            // echo $sql;
            $result = mysqli_query($conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
        
            $search_result = mysqli_query($conn, $sql) or die("cannot search");
            $r = mysqli_num_rows($search_result);
        } else {
            $total_pages_sql = "SELECT COUNT(*) FROM product WHERE Removed<>'1'";
            $sql = "SELECT * FROM product WHERE Removed<>'1' LIMIT ".$offset." , ".$no_of_records_per_page;
        
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
                $output .= "<p><a class='btn btn-secondary' href='./update.php?pid=" . $ProductID . "' role='button'>Update &raquo;</a></p>";
                $output .= "<p><a class='btn btn-danger' href='./delete.php?pid=" . $ProductID . "' role='button'>Delete &raquo;</a></p></div>";
            }
        }
        
        $output .= "</div>";
        mysqli_close($conn);
        echo $output;
    }
    else // customer interface
    {         
        
        $output = "";
        $output = "<div class='row' id='products'>";
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }
        
        if (isset($_POST['search'])) {
            $total_pages_sql = "SELECT COUNT(*) FROM product WHERE Removed<>'1' AND  ";
            $sql = "SELECT * FROM product WHERE Removed<>'1' AND ";
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

            $sql .= " LIMIT ".$offset." , ".$no_of_records_per_page;
        
            // echo $sql;
            $result = mysqli_query($conn, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);
        
            $search_result = mysqli_query($conn, $sql) or die("cannot search");
            $r = mysqli_num_rows($search_result);
        } else {
            $total_pages_sql = "SELECT COUNT(*) FROM product WHERE Removed<>'1'";
            $sql = "SELECT * FROM product WHERE Removed<>'1' LIMIT ".$offset." , ".$no_of_records_per_page;
        
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
        $paginglist = "";
        for($x=1; $x <= $total_pages; $x++)
        {
            $paginglist .= "  <li><a href='?pageno=".$x."'>Page ".$x."</a></li>  ";
        }


        echo $output;
    }



?>
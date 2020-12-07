# Final Project

## Coffee & Tea Distributor

---

## Set Up Database

|     Name     |       Type      |
| :----------: | :-------------: |
|  project     | utf8_general_ci |

1. [Manage database (wamp)](http://localhost/phpmyadmin/index.php)

    Create a new database named "project".

2. create-table.sql
Added "Rremoved" to table "Product", deafault is 0, not removed; 1 for removed. Soft delete.

3. insert-datas.sql
Updated data to hashed password. For testing.
Admin data can only be inserted by us. Cannot register as an admin.

---

## Connection To Database

将参数信息放在info.ini文件中。

用以下php代码读取配置参数：

page.php

```php
$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"]);
if (mysqli_connect_errno($conn)) {
    die('Connect Error (' . $conn->connect_errno . ') '
        . $conn->connect_error);
}
$sql = "SELECT * FROM product WHERE ProductID=$pid";
$result = mysqli_query($conn, $sql);
if ($result != null) {
    // do something here
}else{
    // do something here
}
```

info.ini

```
servername="localhost"
username="root"
password=""
dbname="project"
```

---

## Pages

### partial/header.php
调用方法：

```php
<?php include "partial/header.php"; ?>
```

引用位置：

1. index.php
2. detail.php
3. cart.php 
4. place_order.php

### index.php

1. navbar login -> move to partial/navbar.php

    调用方法：

    ```php
    <?php include "partial/navbar.php"; ?>
    ```

    引用位置：
    
    1. index.php
    2. detail.php
    3. cart.php 
    4. place_order.php

2. search: Filtering needed (?) (with categories)

3. item rows: 

    `id="coffee-row"`: Put all the coffee items in this row

    `id="tea-row"`: Put all the tea items in this row


### login.html

### signup.html


### cart.php

需要获取登录用户的account_id

### detail.php

product详细信息页面。

通过`Get`获取地址栏的product参数。

``` php
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pid = $_GET['pid'];
}
// echo "pid: $pid";
?>
```

### order.php

### order_detail.php


## Product - Name and ID

### Coffee

Category: coffee

ProductID: 1***

Example:

    Name: coffee1
    ProductID: 11

### Tea

Category: coffee

ProductID: 2***

Example:

    Name: tea1
    ProductID: 21

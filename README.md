# Final Project

## Coffee & Tea Distributor

| Name           | NetID      |
| -------------- | ---------- |
| Shengxuan Zhao | sxz branch |
| Dayuan Chen    | dxc190002  |
| Miao Miao      | mxm190020  |


## Set Up Database

### Create Database 

|     Name     |       Type      |
| :----------: | :-------------: |
|  project     | utf8_general_ci |


## Pages

### index.php

1. navbar login：需要动态变化，登陆后变为购物车按钮

2. search: Filtering needed (?) (with categories)

3. item rows: 

    `id="coffee-row"`: Put all the coffee items in this row

    `id="tea-row"`: Put all the tea items in this row

---
### login.html

### signup.html

---
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
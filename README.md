# Final Project

## Coffee & Tea Distributor

| Name           | NetID      |
| -------------- | ---------- |
| Shengxuan Zhao | sxz branch |
| Dayuan Chen    | dxc190002  |
| Miao Miao      | mxm190020  |


## Set Up Database

### Create Database 

Name: project

Type: utf8_general_ci


## Pages
### index.php

#### navbar

home, coffee, tea, about

login：需要动态变化，登陆后变为购物车按钮


#### main

##### search
Added search & input
Filtering needed (?) (with categories)

##### container

###### id="coffee-row"

Put all the coffee items in this row

###### id="tea-row"

Put all the tea items in this row

---
### login.html
### signup.html

---
### cart.php
需要获取登录用户的account_id
### detail.php
product详细信息页面
通过Get方式获取地址栏的product参数
``` php
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $pid = $_GET['pid'];
}
// echo "pid: $pid";
?>
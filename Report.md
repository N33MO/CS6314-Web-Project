# CS 6301 - Final Project - Coffee & Tea Distributor

## Team Members

| Name           | NetID      |
| -------------- | ---------- |
| Shengxuan Zhao | sxz190000 |
| Dayuan Chen    | dxc190002  |
| Miao Miao      | mxm190020  |

## Project Description



## Database Description

We store the database connection information in info.ini file and read it using PHP code like below.

```php
$ini = parse_ini_file("info.ini");
$conn = mysqli_connect($ini["servername"], $ini["username"], $ini["password"], $ini["dbname"]);
```

There are 5 tables in this database, the statements used to creating tables are stored in file `Database/create-tables.sql`.

1. USER

``` mysql
CREATE TABLE USER (
	AccountID	INT AUTO_INCREMENT,
	Fname		VARCHAR(25) NOT NULL,
	Lname		VARCHAR(25) NOT NULL,
	UserName	VARCHAR(25) NOT NULL,
	Password	VARCHAR(1000) NOT NULL,
	Category	INT NOT NULL DEFAULT 0,
	Phone		CHAR(10),
	Email		VARCHAR(40),
	PRIMARY KEY	(AccountID)
);
```

2. PRODUCT

``` mysql
CREATE TABLE PRODUCT (
	ProductID	INT AUTO_INCREMENT,
	Name		VARCHAR(50) NOT NULL,
	Price		DECIMAL(10, 2) NOT NULL,
	Num	        INT NOT NULL,
	Category	VARCHAR(50) NOT NULL,
	Description	VARCHAR(200),
	Image		VARCHAR(50),
	Removed		INT NOT NULL DEFAULT 0,	
	PRIMARY KEY (ProductID)
);
```

3. PURCHASED_ORDER

``` mysql
CREATE TABLE PURCHASED_ORDER (
	OrderID		INT AUTO_INCREMENT,
	AccountID	INT NOT NULL,
	PurchaseDate	DATE NOT NULL,
	TotalPrice	DECIMAL(10, 2) NOT NULL,
	Comments	VARCHAR(200),
	PRIMARY KEY (OrderID),
	FOREIGN KEY (AccountID) REFERENCES USER(AccountID) ON DELETE CASCADE
);
```

4. ORDER_DETAIL

``` mysql
CREATE TABLE ORDER_DETAIL (
	OrderID		INT,
	ProductID	INT,
	Name		VARCHAR(50) NOT NULL,
	PurchasedPrice		DECIMAL(10, 2) NOT NULL,
	Num 	    INT NOT NULL,
	PRIMARY KEY (OrderID, ProductID),
	FOREIGN KEY (OrderID) REFERENCES PURCHASED_ORDER(OrderID) ON DELETE CASCADE
);
```

5. CART_OWN_PRODUCT

``` mysql
CREATE TABLE CART_OWN_PRODUCT (
	AccountID	INT,
	ProductID	INT,
	Num		INT NOT NULL,
	PRIMARY KEY (AccountID, ProductID),
	FOREIGN KEY (AccountID) REFERENCES USER(AccountID) ON DELETE CASCADE,
	FOREIGN KEY (ProductID) REFERENCES PRODUCT(ProductID) ON DELETE CASCADE
);
```



## Languages/frameworks

PHP

## Screenshots

### 1. index for customer

![image-20201206175912499](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206175912499.png)

### 2. index with search/filtering

Result for category="tea" and search="6", admin page

![image-20201206182203869](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206182203869.png)

### 3. admin add/update

![image-20201206182240859](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206182240859.png)

![image-20201206182259174](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206182259174.png)

### 4. user shopping cart

![image-20201206182511893](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206182511893.png)

### 5. user orders/order details

![image-20201206190002432](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206190002432.png)

![image-20201206190020893](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206190020893.png)

### 6. product detail

![image-20201206190030491](C:\Users\miaomiao\AppData\Roaming\Typora\typora-user-images\image-20201206190030491.png)

## Work Division

#### Shengxuan Zhao

##### Database Design

##### Frontend & Backend

#####login.php, register.php, logout.php

1. Provide customers and admins a portal to login.

2. Let new customer to sign up. Check whether this user name is exist first. If not, insert customer's information and hashed password into database.

3. Check if user's input is valid, show the error message if it's not. For example, valid password is at least 8 characters.

4. Logout after the user finish, destory the session and empty the cookies.

#####index.php, navbar.php, products.php

1. Implemented paging function, on the bottom of browsing page. Total page number can be calculated dynamically.

2. Implemented search function. Users can filter the products based on the category(coffee or tea or all) and can search according to the key words(partial match with product name). Search and filtering are integrated together.

#### Dayuan Chen

##### Database Design

##### Frontend & Backend

#####add.php, addtodatabase.php, delete.php, update.php, updatetodatabase.php

1. For admin users, to manage the product database.

2. Add a new item by inputting all product information.

3. Delete a item by clicking the delete button. Implemented soft delete.

4. Update item information by inputing new values of certain attributes.

#####index.php, navbar.php, products.php

1. Show the products and their information to the current user according to their privilege. For guests, they can only browse the items and their detail; for customers, they can add intems into their cart; for the admins, they can list all items and remove(soft delete)\update\add items by additional buttons and links.

2. Navigation bar will show different greeting messages to different users.

#### Miao Miao

##### Database Design

##### Frontend & Backend

###### cart.php, add_cart.php, remove_cart.php

1. Show a list of items in user's shopping cart.

2. Add item from `detail.php` page to shopping cart.

3. Remove item from shopping `cart.php` page.

4. Show total price of items in shopping cart.

###### order.php, order_detail.php

1. Place order in shopping `cart.php` page.

2. Show a list of user's order in `order.php` page.

3. Show items included in an order in `order_detail.php` page.
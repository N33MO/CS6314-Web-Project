CUSTOMER ( <u>**AccountID**</u>, Fname, Lname, DateOfBirth, SSN, UserName, Password, Payment, MailAddr, BillAddr, Phone, Email)

ADMIN (<u>**AccountID**</u>, Fname, Lname, DateOfBirth, SSN, UserName, Password)

BATCH (<u>**BatchID**</u>, <u>**ProductID**</u>[FK -> PRODUCT.ProductID], StoreNum, StockNum, StockDate)

PRODUCT (<u>**ProductID**</u>, Name, Price, Description, Image, ExpirationDate, Num)

FOOD_ORDER (<u>**OrderID**</u>,<u> **AccountID**</u>[FK -> CUSTOMER.AccountID], PurchaseDate, TotalPrice, Comments) 

ORDERDETAIL (<u>**OrderID**</u>[FK -> ORDER.OrderID], Name, ProductID, Number, Price)

ORDER_OWN_PRODUCT <u>(**OrderID**</u>[FK -> ORDER.OrderID], <u>**ProductID**</u>[FK -> PRODUCT.ProductID], Number)

CART <u>**AccountID**</u>[FK -> CUSTOMER.AccountID], TotalPrice)

CART_OWN_PRODUCT (<u>**AccountID**</u>[FK -> CUSTOMER.AccountID], <u>**ProductID**</u>[FK -> PRODUCT.ProductID], Number)

WISHLIST (<u>**AccountID**</u>[FK -> CUSTOMER.AccountID])

WISHLIST_OWN_PRODUCT (<u>**AccountID**</u>[FK -> CUSTOMER.AccountID], <u>**ProductID**</u>[FK -> PRODUCT.ProductID])
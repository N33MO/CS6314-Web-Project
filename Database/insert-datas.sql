
INSERT INTO `user`(
    `AccountID`,
    `Fname`,
    `Lname`,
    `UserName`,
    `Password`,
    `Category`
)
VALUES(
    '11',
    'Admin01_F',
    'Admin01_L',
    'admin01',
    '123456789',
    '1'
),
(
    '12',
    'Admin02_F',
    'Admin02_L',
    'admin02',
    '123456789',
    '1'
);

INSERT INTO `user`(
    `AccountID`,
    `Fname`,
    `Lname`,
    `UserName`,
    `Password`,
    `Phone`,
    `Email`
)
VALUES(
    '21',
    'Customer01_F',
    'Customer01_L',
    'customer01',
    '1111111111',
    NULL,
    'user1@email.com'
),
(
    '22',
    'Customer02_F',
    'Customer02_L',
    'customer02',
    '2222222222',
    NULL,
    "user2@email.com"
);

INSERT INTO `product`(
    `ProductID`,
    `Name`,
    `Price`,
    `Num`,
    `Category`,
    `Description`,
    `Image`
)
VALUES(
    '11',
    'coffee1',
    '10',
    '30',
    'coffee',
    'This is coffee #1.',
    'coffee1.jpg'
),(
    '12',
    'coffee2',
    '10',
    '30',
    'coffee',
    'This is coffee #2.',
    'coffee2.jpg'
),
(
    '21',
    'tea1',
    '12',
    '32',
    'tea',
    'This is tea #1.',
    'tea1.jpg'
);

INSERT INTO `cart_own_product` (`AccountID`, `ProductID`, `Num`) 
VALUES ('1', '11', '2'), ('1', '21', '1');
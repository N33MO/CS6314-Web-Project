
INSERT INTO `admin`(
    `AccountID`,
    `Fname`,
    `Lname`,
    `UserName`,
    `Password`
)
VALUES(
    '1',
    'Admin01_F',
    'Admin01_L',
    'admin01',
    '123456789'
);
INSERT INTO `admin`(
    `AccountID`,
    `Fname`,
    `Lname`,
    `UserName`,
    `Password`
)
VALUES(
    '2',
    'Admin02_F',
    'Admin02_L',
    'admin02',
    '123456789'
);

INSERT INTO `customer`(
    `AccountID`,
    `Fname`,
    `Lname`,
    `UserName`,
    `Password`,
    `Phone`,
    `Email`
)
VALUES(
    '1',
    'Customer01_F',
    'Customer01_L',
    'customer01',
    '1111111111',
    NULL,
    NULL
);
INSERT INTO `customer`(
    `AccountID`,
    `Fname`,
    `Lname`,
    `UserName`,
    `Password`,
    `Phone`,
    `Email`
)
VALUES(
    '2',
    'Customer02_F',
    'Customer02_L',
    'customer02',
    '2222222222',
    NULL,
    NULL
);

INSERT INTO `product`(
    `ProductID`,
    `Name`,
    `Price`,
    `Num`,
    `Description`,
    `Image`
)
VALUES(
    '1',
    'coffee1',
    '10',
    '30',
    'This is coffee #1.',
    'coffee1.jpg'
);
INSERT INTO `product`(
    `ProductID`,
    `Name`,
    `Price`,
    `Num`,
    `Description`,
    `Image`
)
VALUES(
    '2',
    'coffee2',
    '12',
    '32',
    'This is coffee #2.',
    'coffee2.jpg'
);
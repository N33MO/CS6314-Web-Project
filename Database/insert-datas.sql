
INSERT INTO `user`(
    `Fname`,
    `Lname`,
    `UserName`,
    `Password`,
    `Category`,
    `Phone`,
    `Email`
)
VALUES(
    '1',
    'Lowe',
    'James',
    'customer01',
    '$2y$10$YkMnsTdmf5AOe9Xlzi1wRemPtajLpUi86MrR/WlL.pu.fxdWBv7i6',
    '0',
    '8473945601',
    'customer01@email.com'
),
(
    '2',
    'Smith',
    'John',
    'admin01',
    '$2y$10$QFe7Ein6hcKefJDMXM5QCeGQPOs5MtK7.j3S6SfGO6Lc9ljLsKVL.',
    '1',
    '5647290748',
    'admin01@email.com'
),
(
    '3',
    'Burke',
    'Stephen',
    'customer03',
    '$2y$10$2dvq527qCuOytnJlBxYcm.WbObEf6AF94zpVjDGNfBiLZA5SxNTaW',
    '0',
    '2094889205',
    'customer02@email.com'
);

INSERT INTO `cart_own_product` (`AccountID`, `ProductID`, `Num`) 
VALUES ('1', '11', '2'), ('1', '21', '1');
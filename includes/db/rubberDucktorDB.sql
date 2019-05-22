DROP DATABASE IF EXISTS RubberDucktor;
CREATE DATABASE RubberDucktor;
USE RubberDucktor;




-- Table structure for 'Product'

CREATE TABLE Product (
    itemID int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    itemName varchar (40) NOT NULL,
    itemIssueDate date NOT NULL,
    itemDescription varchar(255),
    itemOnSalePrice int(20),
    itemPrice int(20) NOT NULL,
    itemSize varchar(25) NOT NULL,
    itemImg_url varchar(255) NULL,
    isFeatured int(1) DEFAULT 0
);

-- Table structure for 'Postal code'

CREATE TABLE PostalCode (
code varchar(8) PRIMARY KEY NOT NULL,
city varchar(50) NOT NULL
);


-- Table structure for 'Address'

CREATE TABLE `Address` (
    addressID int(8) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    street varchar(40) NULL,
    postalCode varchar(8) NULL,
    country varchar(40) NULL,
    FOREIGN KEY (postalCode) REFERENCES PostalCode (code)
);


-- Table structure for 'Customer'

CREATE TABLE Customer (
customerID int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
firstName varchar(255) NOT NULL,
lastName varchar(255) NOT NULL,
email varchar(255) NOT NULL,
password varchar(60) NOT NULL,
isAdmin int(1) NOT NULL,
addressID int(8) NULL,
FOREIGN KEY (addressID) REFERENCES `Address` (addressID)
);

-- Table structure for 'Order'

CREATE TABLE `Order` (
orderID int(11) AUTO_INCREMENT NOT NULL PRIMARY KEY,
customerID int(11),
FOREIGN KEY (customerID) REFERENCES Customer (customerID),
shippingAddress int(8) NULL,
billingAddress int(8) NOT NULL,
FOREIGN KEY (shippingAddress) REFERENCES `Address` (addressID),
FOREIGN KEY (billingAddress) REFERENCES `Address` (addressID),
createdAt date NOT NULL,
orderPrice int(255) NOT NULL,
isCancelled int(1) NULL,
isCompleted int(1) NULL
);

-- Table structure for 'Company'

CREATE TABLE `Company` (
id int AUTO_INCREMENT PRIMARY KEY,
companyName varchar(255) NOT NULL,
companyDescription varchar(30000) NOT NULL,
companyEmail varchar(255) NOT NULL,
companyPhone varchar(255) NOT NULL,
companyStreet varchar(255) NOT NULL,
companyCity varchar(255) NOT NULL,
companyPostal varchar(8) NOT NULL,
companyOpeningH varchar(255) NULL,
companyOpeningD varchar(255) NULL

);

-- Table structure for 'News'

CREATE TABLE News (
id int AUTO_INCREMENT PRIMARY KEY,
newsTitle varchar(255) NOT NULL,
newsPreview varchar(255) NOT NULL,
newsText varchar(15000) NOT NULL,
newsAuthor varchar(255) NOT NULL,
newsDate date
);

-- Junction for 'OrderLine'

CREATE TABLE OrderLine (
OrderLineID int(3) PRIMARY KEY AUTO_INCREMENT NOT NULL,
orderID int(11) DEFAULT NOT NULL,
itemID int(8) DEFAULT NOT NULL,
FOREIGN KEY (orderID) REFERENCES `Order` (orderID),
FOREIGN KEY (itemID) REFERENCES Product (itemID),
OrderQuantity int(15) NOT NULL
)


-- Stored Procedure 'SelectFeaturedProducts' (Using delimiter so we can pass the procedure as a whole, instead of letting mysql tool interpret it line-by-line.)

DELIMITER //
 CREATE PROCEDURE SelectFeaturedProducts()
   BEGIN
   SELECT *  FROM product WHERE isFeatured = 1;
   END //
 DELIMITER ;

-- Stored Procedure 'TotalProducts'

DELIMITER //
  CREATE PROCEDURE TotalProducts()
  BEGIN
    SELECT  count(*)
    FROM product;
  END //
DELIMITER ;

-- View 'OnSaleProducts'

CREATE VIEW OnSaleProducts AS
SELECT itemID, itemName, itemOnSalePrice, itemImg_url
FROM product
WHERE itemOnSalePrice > 0;

-- View 'ShippedOrders'

CREATE VIEW ShippedOrders AS
SELECT orderID, CustomerID
FROM `order`
WHERE isCompleted = 1;

-- View 'CancelledOrders'

CREATE VIEW CancelledOrders AS
SELECT orderID, CustomerID
FROM `order`
WHERE isCancelled = 1;

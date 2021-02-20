CREATE DATABASE Project1_PHP;
USE project1_php;
CREATE TABLE BookInventory(
bookid INT PRIMARY KEY auto_increment,
bookname VARCHAR(50) NOT NULL,
quantity INT NOT NULL
);
CREATE TABLE BookInventoryOrder(
orderid INT PRIMARY KEY auto_increment,
firstname VARCHAR(50) NOT NULL,
lastname VARCHAR(50) NOT NULL,
paymentoption VARCHAR(8) NOT NULL,
bookname VARCHAR(50) NOT NULL
);
#drop table bookinventory;
#drop table bookinventoryorder;
 -- create and select the database
-- change your_server_user_name in the following line before running this file
USE jagthmi;  -- MySQL command

-- drop tables if already exist
DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS appointments;
DROP TABLE IF EXISTS login;

-- create the tables

CREATE TABLE customers (
  Email 		     VARCHAR(80)    NOT NULL,
  Last_Name          VARCHAR(20)    NOT NULL,
  First_Name         VARCHAR(20)   	NOT NULL,
  Address            VARCHAR(500)  	NOT NULL,
  Phone              INT(10)        DEFAULT FALSE,
  PRIMARY KEY (Email)
);

CREATE TABLE services (
  Service_ID         INT(5)         NOT NULL,   
  Service_Name 		 VARCHAR(80) 	NOT NULL,
  Description        VARCHAR(500)   NOT NULL,  
  Duration 			 TIME			NOT NULL,
  PRIMARY KEY (Service_ID)
);

CREATE TABLE appointments (
  Service_ID        INT(5)         	NOT NULL,
  Service_Date	    DATETIME		NOT NULL,  
  Email             VARCHAR(80)    	DEFAULT NULL,
  Notes             VARCHAR(500)   	DEFAULT NULL,
  PRIMARY KEY (Service_ID, Service_Date),
  CONSTRAINT FOREIGN KEY (Service_ID) references services (Service_ID)  
);

CREATE TABLE login (
  Email            	VARCHAR(80)     NOT NULL,
  Password          VARCHAR(20)     NOT NULL,
  PRIMARY KEY (Email, Password),
  CONSTRAINT FOREIGN KEY (Email) references customers (Email)  
);

-- populate the database
INSERT INTO customers (Email, Last_Name, First_Name, Address, Phone)
VALUES
('jjenkins@gmail.com', 'Jenkins', 'Jennifer', '20 Plum St Dayton, Ohio, 45234', 9378782100);

INSERT INTO services (Service_ID, Service_Name, Description, Duration)
VALUES
(1001, 'Center-Based Session', '2 hours of therapist-led ABA therapy at a regional ABA center', '02:00:00'),
(1002, 'Home-Based Session', '2 hours of therapist-led ABA therapy at the clients home', '03:00:00'),
(1003, 'School-Based Session', 'Full-day, 1:1 behavioral aide at the client school', '08:00:00');

INSERT INTO appointments (Service_ID, Service_Date)
VALUES
(1001,'2017-11-27 08:00:00'),
(1001,'2017-11-27 10:00:00'),
(1001,'2017-11-27 12:00:00'),
(1001,'2017-11-27 14:00:00'),
(1001,'2017-11-27 16:00:00'),
(1001,'2017-11-27 18:00:00'),
(1001,'2017-11-28 08:00:00'),
(1001,'2017-11-28 10:00:00'),
(1001,'2017-11-28 12:00:00'),
(1001,'2017-11-28 14:00:00'),
(1001,'2017-11-28 16:00:00'),
(1001,'2017-11-28 18:00:00'),
(1001,'2017-11-29 08:00:00'),
(1001,'2017-11-29 10:00:00'),
(1001,'2017-11-29 12:00:00'),
(1001,'2017-11-29 14:00:00'),
(1001,'2017-11-29 16:00:00'),
(1001,'2017-11-29 18:00:00'),
(1001,'2017-11-30 08:00:00'),
(1001,'2017-11-30 10:00:00'),
(1001,'2017-11-30 12:00:00'),
(1001,'2017-11-30 14:00:00'),
(1001,'2017-11-30 16:00:00'),
(1001,'2017-11-30 18:00:00'),
(1001,'2017-12-01 08:00:00'),
(1001,'2017-12-01 10:00:00'),
(1001,'2017-12-01 12:00:00'),
(1001,'2017-12-01 14:00:00'),
(1001,'2017-12-01 16:00:00'),
(1001,'2017-12-01 18:00:00'),
(1001,'2017-12-02 08:00:00'),
(1001,'2017-12-02 10:00:00'),
(1001,'2017-12-02 12:00:00'),
(1001,'2017-12-02 14:00:00'),
(1001,'2017-12-02 16:00:00'),
(1001,'2017-12-02 18:00:00'),


(1002,'2017-11-27 08:00:00'),
(1002,'2017-11-27 11:00:00'),
(1002,'2017-11-27 13:00:00'),
(1002,'2017-11-27 16:00:00'),
(1002,'2017-11-28 08:00:00'),
(1002,'2017-11-28 11:00:00'),
(1002,'2017-11-28 13:00:00'),
(1002,'2017-11-28 16:00:00'),
(1002,'2017-11-29 08:00:00'),
(1002,'2017-11-29 11:00:00'),
(1002,'2017-11-29 13:00:00'),
(1002,'2017-11-29 16:00:00'),
(1002,'2017-11-30 08:00:00'),
(1002,'2017-11-30 11:00:00'),
(1002,'2017-11-30 13:00:00'),
(1002,'2017-11-30 16:00:00'),
(1002,'2017-12-01 08:00:00'),
(1002,'2017-12-01 11:00:00'),
(1002,'2017-12-01 13:00:00'),
(1002,'2017-12-01 16:00:00'),
(1002,'2017-12-02 08:00:00'),
(1002,'2017-12-02 11:00:00'),
(1002,'2017-12-02 13:00:00'),
(1002,'2017-12-02 16:00:00'),
(1003,'2017-11-27 08:00:00'),
(1003,'2017-11-28 08:00:00'),
(1003,'2017-11-29 08:00:00'),
(1003,'2017-11-30 08:00:00'),
(1003,'2017-12-01 08:00:00');

INSERT INTO login (Email, Password)
VALUES
('jjenkins@gmail.com', 'jenkins1243');



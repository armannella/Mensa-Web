<?php 
// query for setup the tables before run the website : 

use App\core\DB ;

// define tables 

$query = '

CREATE TABLE canteens (
    id int AUTO_INCREMENT PRIMARY KEY ,
    name varchar(200) ,
    address varchar(255) ,
    username varchar(200) UNIQUE ,
    password varchar(255)
);

CREATE TABLE students (
    id int AUTO_INCREMENT PRIMARY KEY ,
    Fname varchar(200) ,
    Lname varchar(200),
    matricola varchar(10) UNIQUE ,
    username varchar(200) UNIQUE ,
    password varchar(255) ,
    balance DECIMAL(10,2) default 0.00,
    image varchar(500)
);

CREATE TABLE types (
    id int AUTO_INCREMENT PRIMARY KEY ,
    name varchar(200) ,
    price DECIMAL(10,2) 
);

CREATE TABLE foods (
    id int AUTO_INCREMENT PRIMARY KEY ,
    name varchar(200) ,
    details varchar(500) ,
    typeID int ,
    image varchar(500),
    FOREIGN KEY (typeID) REFERENCES types(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE menus (
    id int AUTO_INCREMENT PRIMARY KEY ,
    menu_date DATE ,
    meal ENUM("lunch" , "dinner") ,
    canteenID int ,
    UNIQUE (canteenID, menu_date, meal),
    FOREIGN KEY (canteenID) REFERENCES canteens(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE menu_details (
    id int AUTO_INCREMENT PRIMARY KEY ,
    menuID int ,
    foodID int ,
    quantity int ,
    UNIQUE (menuID, foodID),
    FOREIGN KEY (foodID) REFERENCES foods(id) ON DELETE CASCADE ON UPDATE CASCADE ,
    FOREIGN KEY (menuID) REFERENCES menus(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE reserves (
    id int AUTO_INCREMENT PRIMARY KEY ,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    menuID int ,
    studentID int ,
    price DECIMAL(10,2) ,
    status ENUM("reserved","delivered","cancelled") default "reserved" ,
    UNIQUE (menuID, studentID),
    FOREIGN KEY (menuID) REFERENCES menus(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (studentID) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE reserve_details (
    id int AUTO_INCREMENT PRIMARY KEY ,
    reserveID int ,
    foodID int ,
    UNIQUE (reserveID, foodID),
    FOREIGN KEY (reserveID) REFERENCES reserves(id) ON DELETE CASCADE ON UPDATE CASCADE ,
    FOREIGN KEY (foodID) REFERENCES foods(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE payments (
    id int AUTO_INCREMENT PRIMARY KEY ,
    created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    studentID int ,
    amount DECIMAL(10,2) ,
    FOREIGN KEY (studentID) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE
);

' ;

DB::queryExecuter($query,[],'check');


//initialize tables 

$canteens = [['Papardo Mensa', 'Unviersita di Messina , Papardo Campus' , 'papardo' , '123456'],['Centro Mensa', 'viale Cairoli' , 'centrale' , '123456'],['Annunziata Mensa', 'Unviersita di Messina , Annunziata Campus' , 'annunziata' , '123456']];
foreach($canteens as $canteen){
    $query = " INSERT INTO canteens(name,address,username,password) VALUES (:n,:a,:u,:p) ";
    DB::queryExecuter($query,['n' => $canteen[0], 'a' => $canteen[1] , 'u' => $canteen[2] , 'p' => password_hash($canteen[3],PASSWORD_DEFAULT)],'check');
}

$types = [['primo',1.50],['secondo', 1.00],['insalata', 0.50 ],['panino', 1 ],['pizza', 2]];
foreach($types as $type){
    $query = " INSERT INTO types(name,price) VALUES (:n,:p) ";
    DB::queryExecuter($query,['n' => $type[0], 'p' => $type[1] ] ,'check');
}

?>

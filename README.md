🍽️ University Mensa Simulation Web Application

A full-stack web application that simulates and improves the university canteens (Mensa) reservation system.
This project was fully developed from scratch without using AI-generated code.

Developed as a Web Programming course project at the University of Messina.

📌 About The Project

This project was designed to solve real-world problems in the university canteen system, such as:

Long queues during peak hours

Lack of meal availability transparency

No demand forecasting for daily meals

Inefficient reservation management

The system allows students to reserve meals in advance and enables canteen staff to manage menus and monitor reservations effectively.

This project was fully developed from scratch without using AI-generated code.

🏗️ Architecture

The project follows the MVC (Model-View-Controller) design pattern:

Model → Handles database logic

View → User interface layer

Controller → Business logic

Router → Manages routes and requests

Front-end and back-end are fully separated.

🛠️ Technologies Used
Front-End

HTML

CSS

Bootstrap

JavaScript

UI design inspired by Metro UI from Microsoft (introduced in Windows 8).

Back-End

Core PHP (No frameworks)

Database

MySQL

PDO for secure database connection

Database normalized to 3NF

👥 User Roles
🎓 Student

Register & Login

View daily menus

Reserve meals

View reservation details

Change password

Update profile picture

Charge account balance

View transaction history

Receive meal using reservation code

🏢 Mensa Staff

Create and manage meals

Define daily menus

Set meal quantity limits

View reservation statistics

Canteen meal delivery using reservation codes

🚀 Key Features

Advanced meal reservation system

Reservation tracking

Transaction history management

Quantity-based meal availability

Real-time reservation statistics

Dashboard system for both roles

📊 Database Design

Fully normalized (3NF)

Secure communication using PDO

Structured relational schema

🔮 Future Improvements

Notification system

Mobile app version

Online payment integration

RESTful API

Advanced analytics dashboard

Security enhancements


⚙️ Installation

Clone the repository:

git clone https://github.com/armannella/mensa-web.git


Import the database file into MySQL by running the queries in file :

/configs/instal_db.php

Configure your database connection in:

/configs/db_config.php


Run the project on a local server (XAMPP / WAMP / LAMP).

📄 License

This project was developed for educational purposes.

👨‍💻 Author

Arman Khademi
Web Programming Course Project
University of Messina

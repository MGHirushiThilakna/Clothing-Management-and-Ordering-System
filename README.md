# 👗 Web-based Clothing Management and Ordering System – HAH Collections

 ## 📄 Project Overview
The **Web-based Clothing Management and Ordering System** is a custom-built application developed for **HAH Collections**, a city-center clothing store with a rapidly growing customer base.The system streamlines clothing product ordering, inventory control, and customer management by replacing manual processes with a centralized online solution. Customers can browse products, place and track orders, make secure payments, and request returns, while administrators can manage orders, inventory, offers, reports, and employee accounts.

---

## ✨ Features

### - Customer Features
- Browse clothing products by category and type
- Add items to a **shopping cart**
- Apply promotional offers during checkout
- Place and confirm online orders
- Track order status (Processing, Shipped, Delivered)
- Order cancellation and return requests
- Maintain personal account and order history

### - Administrator Features
- Manage product catalog (Add/Update/Delete items)
- Categorize products for easy browsing
- Handle order processing, cancellations, and returns
- Manage promotional offers and discounts
- Generate sales and inventory reports
- Employee account management
- Track supply reordering requirements

### - Additional Functionalities
- Customer support system
- Shopping cart management
- Delivery management and tracking
- Inventory auto-update after sales
- 
---

## - Technologies Used
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server Environment:** XAMPP (Apache, MySQL, PHP)
- **Mail servixe:** PhPMailer 

---

## 📂 Project Structure
    ├── assets/ # CSS, JS, and image files
    ├── includes/ # PHP configuration and database connection
    ├── modules/ # Functional modules (products, orders, customers, employees)
    ├── admin/ # Administrator dashboard and management pages
    ├── customer/ # Customer-facing pages
    ├── database/ # SQL database files
    └── index.php # Home page
## - Installation Guide

### Prerequisites
- XAMPP or any local server environment (Apache, MySQL, PHP)
- Git (optional, for cloning)
- Modern web browser

### Steps
1. **Clone the Repository**
   ```
   git clone https://github.com/MGHirushiThilakna/Clothing-Management-and-Ordering-System
   
- Set Up the Database
- Open phpMyAdmin
- Create a new database (e.g., cmos_db)
- Import the .sql file from the database/ folder

Configure Database Connection
- Edit includes/config.php
  ---
      $host = "localhost";
      $username = "root";
      $password = "";
      $database = "cmos_db"                     
---
- Deploy to Web Server
- Place the project folder in your XAMPP htdocs directory
- Start Services
- Launch XAMPP Control Panel
- Start Apache and MySQL
- Access the Application

Go to: http://localhost/hah-clothing-management-system

## 📷 Screenshots

## - Future Enhancements

- Integration with live payment gateways (PayPal, Stripe)
- Customer loyalty points and rewards system
- Mobile-friendly responsive design
- Live chat customer support
- AI-based product recommendations

## 📜 License

This project is licensed under the MIT License – see the LICENSE file for details.

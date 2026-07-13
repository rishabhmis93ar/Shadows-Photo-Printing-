# Shadows Photo Printing - E-Commerce Platform

Shadows Photo Printing is a full-stack PHP-based e-commerce web application that allows users to upload their photos and place custom photo printing orders online. The platform includes a fully functional shopping system, secure Stripe payment integration, and a dynamic admin dashboard for complete website management.

---

# 📌 Project Overview

This project was developed to provide customers with a smooth and professional online photo printing experience. Users can browse products, upload images, add customized print items to the cart, apply coupons, and complete payments securely using Stripe.

The application also includes a powerful Admin Dashboard where administrators can manage:

* Products
* Categories
* Orders
* Coupons
* Customers
* Website Settings

The system is fully dynamic and database-driven using MySQL.

---

# 🚀 Features

## 👤 User Authentication

* User Registration and Login System
* Secure Session Management
* Profile Photo Upload
* User Account Dashboard
* Edit Account Details
* Address Management
* Order History

---

## 🛍️ Product & Category Management

* Dynamic Product Categories
* Product Detail Pages
* Product Images & Banner Images
* Product Variations (Dimensions, Paper Types, etc.)
* Dynamic Pricing System

---

## 🛒 Shopping Cart System

* Add to Cart
* Update Quantity
* Remove Products
* Session-Based Cart Storage
* Dynamic Cart Total Calculation
* AJAX Cart Functionality

---

## 🎟️ Coupon System

* Fixed Amount Coupons
* Percentage-Based Coupons
* Coupon Expiry Date
* Dynamic Coupon Validation
* Discount Calculation

---

## 💳 Stripe Payment Integration

* Secure Card Payments using Stripe API v3
* Real-Time Payment Processing
* Stripe Payment Method Tokenization
* Payment Success & Failure Handling
* Order Creation After Successful Payment

---

## 📦 Order Management

* Dynamic Order Placement
* Billing & Shipping Address Support
* Order Summary Calculation
* GST & Shipping Calculation
* Order Status Management

---

## ⚙️ Admin Dashboard

The admin panel provides complete control over the website.

### Admin Features:

* Dashboard Overview
* Manage Users
* Manage Categories
* Manage Products
* Manage Blogs
* Manage Coupons
* Manage Orders
* Dynamic CRUD Operations
* Image Upload Management

---

## 📰 Blog Management

* Create Blog Posts
* Update Blogs
* Delete Blogs
* Dynamic Blog Listing

---

## 🎨 Modern UI/UX

* Fully Responsive Design
* Bootstrap 5 Layout
* Slick Slider Integration
* AOS Animation Effects
* Mobile-Friendly Interface
* Smooth Navigation Experience

---

# 🛠️ Tech Stack

## Frontend

* HTML5
* CSS3
* JavaScript
* jQuery
* Bootstrap 5
* Slick Slider
* AOS Animation Library
* Font Awesome Icons

---

## Backend

* PHP
* Procedural + OOP Concepts

---

## Database

* MySQL

---

## Payment Gateway

* Stripe API v3

---

# 📂 Project Structure

```plaintext
Shadows-Photo-Printing/
│
├── admin/                 # Admin Dashboard
├── ajax/                  # AJAX Request Handlers
├── assets/                # CSS, JS, Images
├── auth/                  # Login/Register/Logout
├── config/                # Database & Helper Functions
├── customer/              # Customer Dashboard Pages
├── includes/              # Common Header/Footer Files
├── uploads/               # Uploaded Images
├── index.php              # Homepage
└── README.md
```

---

# ⚙️ Installation & Setup

## 1️⃣ Clone the Repository
git clone https://github.com/rishabhmis93ar/Shadows-Photo-Printing-.git

---

## 2️⃣ Move Project to XAMPP htdocs

Copy the project folder into:
C:\xampp\htdocs\


---

## 3️⃣ Start Apache & MySQL

Open XAMPP Control Panel and start:

* Apache
* MySQL

---

## 4️⃣ Create Database

Open phpMyAdmin and create a database:
shadows_photo_printing

---

## 5️⃣ Import Database

Import the provided SQL file into the database.

---

## 6️⃣ Configure Database Connection

Open:
config/config.php

Update database credentials:
$conn = mysqli_connect("localhost", "root", "", "shadows_photo_printing");


---

## 7️⃣ Configure Base URL

Inside `config/config.php`:

define("BASE_URL", "http://localhost/shadowsphotoprinting-main/");
define("ADMIN_URL", BASE_URL . "admin/");

---

## 8️⃣ Stripe Configuration

Add your Stripe Publishable Key and Secret Key.

Example:

$stripe_secret_key = "your_secret_key";
$stripe_publishable_key = "your_publishable_key";


---

## 9️⃣ Run the Project

Open browser:

http://localhost/shadowsphotoprinting-main/


---

# 🔐 Admin Login

Example Admin URL:

http://localhost/shadowsphotoprinting-main/admin/


---

# 📈 Future Improvements

* Email Notifications
* Order Tracking
* Wishlist System
* Multi-Image Upload Optimization
* PayPal Integration
* Admin Analytics Dashboard
* Inventory Management

---

# 🤝 Contributing

Contributions are welcome.

1. Fork the repository
2. Create a new branch
3. Commit your changes
4. Push to your branch
5. Create a Pull Request

---

# 📄 License

This project is developed for educational and portfolio purposes.

---

# 👨‍💻 Developer

**Rituraj Mishra**
Engineer | Full Stack PHP Developer

GitHub: https://github.com/rishabhmis93ar/Shadows-Photo-Printing-.git

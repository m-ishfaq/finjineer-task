# 📦 Laravel Inventory & Dynamic Pricing System

This is a Laravel-based Inventory and Transaction Management System with dynamic pricing logic. It includes:

- Inventory tracking (sale/restock)
- Smart pricing rules based on:
  - Time of day or week (e.g. weekends or happy hours)
  - Quantity purchased (e.g. bulk discounts)
  - Rule precedence
- Transaction logging and race-condition-safe inventory updates
- Postman collection for testing

---

## 🛠️ Requirements

To run this on **Windows using XAMPP**, you'll need:

- PHP >= 8.1
- MySQL (comes with XAMPP)
- Composer
- Laravel CLI (optional but helpful)
- XAMPP (Apache & MySQL services)
- Postman (for API testing)

---

## 🚀 Getting Started

Follow the steps below to set up the project on your local machine.

### 📁 Step 1: Clone the Repository

```bash
git clone https://github.com/your-username/finjineer-task.git
cd finjineer-task

## ⚙️ Step 2: Start XAMPP

- Open **XAMPP Control Panel**
- Start **Apache**
- Start **MySQL**

---

## 📝 Step 3: Set Up Environment File

Rename `.env.example` to `.env`:

```bash
copy .env.example .env

### Step 4: Install Dependencies
composer install

## 🔐 Step 5: Generate Application Key
```bash
php artisan key:generate

🛢️ Step 6: Create Database & Run Migrations
Open your browser and go to: http://localhost/phpmyadmin

Create a new database named: laravel_inventory

Then run the following command in terminal:

bash
Copy
Edit
php artisan migrate --seed

▶️ Step 7: Start Development Server
bash
Copy
Edit
php artisan serve


📫 Postman API Collection
A Postman collection is included in the project root:

pgsql
Copy
Edit
postman-collection.json
🔄 To Use:
Open Postman

Click Import

Select postman-collection.json

Use the pre-configured endpoints:


```md
# 📦 Laravel Inventory & Dynamic Pricing System

This is a Laravel-based Inventory and Transaction Management System with dynamic pricing logic. It includes:

- ✅ Inventory tracking (sale/restock)
- 💡 Smart pricing rules based on:
  - Time of day or week (e.g. weekends or happy hours)
  - Quantity purchased (e.g. bulk discounts)
  - Rule precedence
- 🧾 Transaction logging and race-condition-safe inventory updates
- 📫 Postman collection for testing

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

---

### 📁 Step 1: Clone the Repository

```bash
git clone https://github.com/your-username/finjineer-task.git
cd finjineer-task

```

----------

### ⚙️ Step 2: Start XAMPP

-   Open **XAMPP Control Panel**
    
-   Start **Apache**
    
-   Start **MySQL**
    

----------

### 📝 Step 3: Set Up Environment File

Rename `.env.example` to `.env`:

```bash
copy .env.example .env

```  

----------

### 📦 Step 4: Install Dependencies

```bash
composer install

```

----------

### 🔐 Step 5: Generate Application Key

```bash
php artisan key:generate

```

----------

### 🛢️ Step 6: Create Database & Run Migrations

1.  Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
    
2.  Create a new database named: `task_finjineer`
    

Then run:

```bash
php artisan migrate --seed

```

This will create all necessary tables and seed them with demo data.

----------

### ▶️ Step 7: Start Development Server

```bash
php artisan serve

```
----------

## 📫 Postman API Collection

A Postman collection is included in the project root:

```text
postman-collection.json

```

### 🔄 To Use:

1.  Open **Postman**
    
2.  Click **Import**
    
3.  Select `postman-collection.json`
    
4.  Use the pre-configured endpoints:
    

----------

## 👤 Author

**Moosa Ishfaq**  
📧 [moosaishfaq461@gmail.com](mailto:moosaishfaq461@gmail.com)  
🔗 [LinkedIn](https://linkedin.com/in/moosa-ishfaq/)

# 💊 SupplementStack - Inventory & Fitness Management

**SupplementStack** is a specialized Inventory Management System (IMS) designed for fitness supplement businesses. It helps store owners track their stock, manage suppliers, and monitor sales performance with a clean, modern interface.

## 🛠️ Tech Stack
* **Backend:** Laravel 12+ (PHP 8.2+)
* **Frontend:** Tailwind CSS & Alpine.js
* **Database:** MySQL
* **Tools:** Artisan CLI, Migrations, and Service Layer Pattern

## 🚀 Core Features
* **📦 Smart Inventory:** Track supplement stock levels with real-time updates.
* **⚠️ Low-Stock Alerts:** Automated visual warnings when products hit a minimum threshold.
* **📉 Sales Analytics:** Overview of daily/monthly revenue and best-selling products.
* **🏢 Supplier Directory:** Manage contact details and orders for various supplement brands.
* **🔒 Secure Auth:** Role-based access control for Admins and Staff.

## 📋 Database Schema
The system uses a relational MySQL database with the following key tables:
* `products`: Stores supplement names, SKU, price, and current quantity.
* `categories`: Groups products (e.g., Whey Protein, Creatine, Pre-workout).
* `suppliers`: Information about wholesalers and distributors.
* `orders`: Records of sales transactions.

## ⚙️ Installation & Setup

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/your-username/SupplementStack.git](https://github.com/your-username/SupplementStack.git)
   cd SupplementStack
   ```

2. Install Composer dependencies:

```Bash
composer install
```
3. Install NPM dependencies & Compile assets:

```Bash
npm install && npm run dev
```
4. Environment Configuration:

```Bash
cp .env.example .env
php artisan key:generate
Update your .env file with your MySQL database credentials.
```
5. Run Migrations & Seeders:

```Bash
php artisan migrate --seed
```
6. Start the local server:

```Bash
php artisan serve
```
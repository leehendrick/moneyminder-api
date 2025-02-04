# 🏦 MoneyMinder API

The **MoneyMinder API** is a personal expense management system that allows users to record, view, and manage their financial transactions.

## 🚀 Technologies Used

- **Laravel 11** - PHP backend framework
- **SQLite** - Lightweight and efficient database
- **Sanctum** - Token-based authentication

## 📌 Requirements

- **PHP 8.2+**
- **Composer**
- **SQLite** (or compatible database)

## 🛠️ Installation and Setup

1. Clone the repository:

   ```sh
   git clone https://github.com/leehendrick/moneyminder-api.git
   cd moneyminder-api
   
2. Install the dependencies:
   ```shell
   composer install

3. Set up the SQLite database:
   ```shell
   touch database/database.sqlite

4. Run the migrations:
   ```shell
   php artisan migrate

5. Run the migrations:
   ```shell
   php artisan migrate

6. Start the server:
   ```shell
   php artisan serve --port=8000

The Api will be available at [http:127.0.0.1:8000](http:127.0.0.1:8000) 🚀

Postman workspace for the api: https://www.postman.com/satellite-geoscientist-91670469/workspace/moneyminder

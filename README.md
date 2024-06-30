<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center"><a href="https://vuejs.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo"></a></p>


# Laravel & Vue.js Technical Test | Simple Article CMS

## Introduction

This project is a web application built with Laravel (PHP framework) and Vue.js (JavaScript framework). It aims to provide a seamless user experience with dynamic and responsive front-end components integrated with a robust back-end.

## Prerequisites

Before you begin, ensure you have met the following requirements:
- PHP >= 8.1
- Composer
- Node.js & npm
- Laravel CLI
- A web server like Apache or Nginx
- MySQL or another supported database

## Installation

### 1 Clone the Repository

```bash
Clone using the web URL
git clone https://github.com/tegarfiqri/his_kishack.git
cd/his_kishack
```

### 2. Install Backend Dependencies
Use Composer to install PHP dependencies:
```bash
composer install
```

### 3 Install Frontend Dependencies
Use npm to install JavaScript dependencies
```bash
npm install
```

### 4 Set Up Environment Variables
copy .env.example and rename it to .env
modify the file and set the host, database, and password so the application can access the database
also change the value of APP_URL variable to http://localhost:8000

### 5 Generate Application Key
```bash
php artisan key:generate
```

### 6 Run Database Migrations and Populate The Database Using Seeder
```bash
php artisan migrate --seed
```

### 7 Compile Assets and Run the application
```bash
npm run dev
php artisan serve
```

### 8 Access the Application
after running php artisan serve, access the application by visiting http://localhost:8000 or copy the server address that shown by the command line

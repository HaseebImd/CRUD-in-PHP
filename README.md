# PHP CRUD - Task Manager

A simple PHP CRUD application for learning basic PHP concepts.

## Requirements

- PHP 7.0 or higher
- MySQL
- Web Server (XAMPP, MAMP, WAMP, or built-in PHP server)

## Setup Instructions

### Step 1: Create Database

Open phpMyAdmin or MySQL terminal and run this SQL:

```sql
-- Create database
CREATE DATABASE IF NOT EXISTS crud_demo;
USE crud_demo;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tasks table
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    status VARCHAR(50) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Step 2: Configure Database Connection

Open `config.php` and update these values if needed:

```php
$host = "localhost";
$username = "root";
$password = "";        // Your MySQL password
$database = "crud_demo";
```

### Step 3: Run the Application

**Option A: Using XAMPP/MAMP**
1. Put project folder in `htdocs` (XAMPP) or `htdocs` (MAMP)
2. Start Apache and MySQL
3. Open browser: `http://localhost/CRUD/`

**Option B: Using PHP Built-in Server**
1. Open terminal in project folder
2. Run: `php -S localhost:8000`
3. Open browser: `http://localhost:8000/`

## Project Structure

```
CRUD/
├── config.php           - Database connection + session start
├── index.php            - Login page (form)
├── process_login.php    - Handles login
├── signup.php           - Signup page (form)
├── process_signup.php   - Handles registration
├── home.php             - Main page (view tasks + add form)
├── create_task.php      - Handles task creation
├── delete_task.php      - Handles task deletion
├── logout.php           - Destroys session
└── README.md            - This file
```

## How It Works

### User Flow
1. User visits `index.php` (Login page)
2. If no account, click "Sign Up" to go to `signup.php`
3. After signup, login with credentials
4. After login, redirected to `home.php`
5. On home page: view tasks, add new tasks, delete tasks
6. Click "Logout" to end session

### Session
- Session stores `user_id` and `user_name` after login
- Protected pages check if session exists
- Logout destroys the session

## Features

- User Registration (Sign Up)
- User Login/Logout
- Create Tasks
- View Tasks (Card Layout)
- Delete Tasks
- Status Badges (Pending, In Progress, Completed)

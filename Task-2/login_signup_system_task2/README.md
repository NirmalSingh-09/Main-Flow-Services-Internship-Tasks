# 🔐 PHP Login & Signup System
A secure and fully functional **Login & Signup System** built using **PHP**, **MySQL**, **HTML**, and **CSS**. T

📌 Features
-  User registration with username, email, and password
-  User login with session management
-  Password hashing using `password_hash()`
-  Password verification using `password_verify()`
-  Protected pages (`home.php` and `profile.php`)
-  Logout functionality with `session_destroy()`
-  Clean, responsive user interface with CSS
-  Prepared statements to prevent SQL injection
-  Error messages for empty fields, incorrect credentials, and duplicate users

## 🛠️ Technologies Used

| Layer     | Technology |
|-----------|------------|
| Frontend  | HTML, CSS  |
| Backend   | PHP        |
| Database  | MySQL      |

## 📂 Folder Structure

login_signup_system_task2/
│
├── index.php          # Login page
├── register.php       # User registration
├── authenticate.php   # Login processing
├── home.php           # Dashboard (protected)
├── profile.php        # Profile (protected)
├── logout.php         # Session destroy & logout
├── style.css          # Styling for all pages
└── README.md          # Documentation
```

🧑‍💻 How to Run This Project Locally
✅ Prerequisites

- XAMPP/WAMP/MAMP installed
- Apache and MySQL running

🔧 Steps
1. **Move project folder to web root**:
   - For XAMPP: `C:/xampp/htdocs/phplogin`
   - For WAMP: `C:/wamp/www/phplogin`

2. **Create MySQL Database**:
   - Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create database: `phplogin`

3. **Create `accounts` Table**:
```sql
CREATE TABLE accounts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  registered DATETIME DEFAULT CURRENT_TIMESTAMP
);

4. **Start Apache and MySQL**

5. **Access the system** in your browser:

http://localhost/login_signup_system_task2/index.php
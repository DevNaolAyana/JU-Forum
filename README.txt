JU FORUM - JIMMA UNIVERSITY DISCUSSION PLATFORM
=================================================

A PHP-based discussion forum platform created for Jimma University students to discuss academic life, share experiences, and connect with fellow students.

REQUIREMENTS
------------
- XAMPP (or any PHP server with MySQL)
- PHP 8.2.12 or higher
- MySQL 10.4.32 or higher

INSTALLATION
------------

1. Setup XAMPP
   - Install XAMPP on your computer
   - Copy the JU-Forum folder to: C:\xampp\htdocs\JU-Forum\

2. Create Database
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create a new database named "forum"

3. Import Database

   Option A: Import with sample data (for testing)
   ------------------------------------------------
   mysql -u root -p forum < database/sample_data.sql
   
   Or import via phpMyAdmin:
   - Select the "forum" database
   - Go to Import tab
   - Choose database/sample_data.sql
   - Click Go

   Option B: Import empty schema (for production)
   ------------------------------------------------
   mysql -u root -p forum < database/schema.sql

LOGIN CREDENTIALS
-----------------

USER ACCOUNTS (All users use the same password)
------------------------------------------------
Password for ALL users: TestTest

Username          | Email
------------------|-------------------------
naolmelaku        | naolmelaku@gmail.com
abdisaketema      | abdisa.ketema@gmail.com
meklitkassahun    | meklit.kassahun@gmail.com
TestTest          | Test@gmail.com

ADMIN ACCOUNTS (All admins use the same password)
-------------------------------------------------
Password for ALL admins: TestAdmin

Admin Name        | Email
------------------|-------------------------
naolmelaku        | naolmelaku@gmail.com
meklitkassahun    | meklit.kassahun@gmail.com
abdisaketema      | abdisa.ketema@gmail.com
TestAdmin         | TestAdmin@gmail.com

ACCESS THE APPLICATION
----------------------

Landing Page:
http://localhost/JU-Forum/

User Registration:
http://localhost/JU-Forum/auth/register.php

User Login:
http://localhost/JU-Forum/auth/login.php
- Use any user email from above
- Password: TestTest

Admin Login:
http://localhost/JU-Forum/admin-panel/admins/login-admins.php
- Use any admin email from above
- Password: TestAdmin

DATABASE STRUCTURE
------------------

The database contains the following tables:
- admins     - Administrator accounts
- categories - Topic categories (Internship, Department Selection, Dormitory, Library, Registrar, etc.)
- users      - User accounts
- topics     - Forum topics/posts
- replies    - Topic replies/comments

FORUM CATEGORIES
----------------

The forum includes discussion categories relevant to Jimma University students:
- Internship          - Discuss internship opportunities and experiences
- Department Selection - Talk about choosing the right department
- Cafe and Non-Cafe   - Share thoughts about campus food services
- Dormitory          - Discuss housing facilities and issues
- Library            - Share library resources and study tips
- Registrar          - Discuss registration processes and academic services

NOTES
-----

- All user accounts share the same password (TestTest) for testing convenience
- All admin accounts share the same password (TestAdmin) for testing convenience
- Sample data includes realistic forum posts about Jimma University topics
- For a clean database without sample data, use schema.sql instead of sample_data.sql

TROUBLESHOOTING
---------------

If you see a directory listing instead of the forum:
1. Make sure index.php exists in the JU-Forum folder
2. Check that Apache is configured to recognize index.php
3. Verify the folder is in htdocs directory
4. Try accessing: http://localhost/JU-Forum/index.php

If you get database connection errors:
1. Ensure MySQL is running in XAMPP control panel
2. Verify the database name is "forum"
3. Check your database credentials in the configuration files

For any issues, check XAMPP control panel to ensure Apache and MySQL are running.

DEVELOPER: 
@DevNaolAyana
---------

Developed for Jimma University as A sample!

HAPPY DISCUSSING! 🎓
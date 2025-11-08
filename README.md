# User Manager University Project

A simple PHP-based user management system for adding, viewing, editing, and deleting users. Data is now stored in a MySQL database (`users` table) for better scalability and security, replacing the previous txt file approach. This project demonstrates core PHP concepts like form handling, PDO for database interactions, and basic security (e.g., `htmlspecialchars` for XSS prevention).
---
## 📌 Commit History (English)
### ✅ Commit 1 – Add basic user management, create and save new user in txt file (no database)
A single-file `index.php` was created with a basic form to add users (name and email) and a table to display them from `users.txt`. New users are appended to the file on form submission.
---
### ✅ Commit 2 – Add delete option for users in txt file
Delete functionality was added via GET links in the table (`?delete=index`). The script reads the file lines, unsets the target line, and rewrites the file. An "action" column and confirmation dialog were included for user safety.
---
### ✅ Commit 3 – Add edit option for users in txt file
Edit support was introduced with GET links (`?edit=index`) that pre-fill the form with user data. POST handling distinguishes add vs. edit via a hidden `edit_index`. The file is read, the target line updated, and rewritten. Form title and buttons adapt dynamically (add/update).
---
### ✅ Commit 4 – Code rewritten and user management logic moved to separate PHP files for better maintainability
The codebase was refactored to improve structure and maintainability. Core logic (add, delete, edit) was extracted into dedicated files: `add.php` (handles POST for new users), `delete.php` (handles GET for removal), `edit.php` (handles POST for updates), and `functions.php` (defines `getUsers` and `saveUsers` helpers). `index.php` was updated to integrate these files, manage forms dynamically (add/edit modes), and link to actions via separate endpoints.
---
### ✅ Commit 5 – Separating the user editing and adding sections from the index file and transferring them to independent files
The add and edit forms were fully separated from `index.php` into standalone files: `add_form.php` (simple HTML form for new users) and `edit_form.php` (PHP form that loads user data via GET `?edit=index` and includes validation for user existence). `index.php` now exclusively displays the user list with direct links to these forms. Processing endpoints (`add.php`, `edit.php`) and `delete.php` remain unchanged for handling submissions and deletions.
---
### ✅ Commit 6 – Code optimization, refactoring, and moving logic into functions
The code was optimized and refactored for efficiency and readability. Separate form files (`add_form.php`, `edit_form.php`) and `delete.php` were removed; forms are now integrated directly into `add.php` (handles both display and POST processing with error messaging) and `edit.php` (handles GET for loading/pre-filling and POST for updates). Delete logic was consolidated into `index.php` via GET handling. `functions.php` was enhanced with dedicated CRUD functions: `addUser`, `editUser`, `deleteUser` (with array re-indexing on delete).
---
### ✅ Commit 7 – Migrate user storage from txt file to mysql database using pdo
Txt file storage was replaced with MySQL database using PDO for secure queries. `functions.php` now includes PDO connection setup (with error handling) and updated CRUD functions (`getUsers`, `addUser`, `editUser`, `deleteUser`) using prepared statements. `add.php` and `edit.php` handle both form display/processing and PDO interactions (with exception catching and null checks). `index.php` uses database IDs for actions and includes connection validation. Requires MySQL with a `users` table (id AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255), email VARCHAR(255) UNIQUE).
---

## 📌 Flashback to Commit 7 (English)
> **Database Setup Guide**  
> To migrate to MySQL, first create the database and table. Update `functions.php` with your DB credentials (host, dbname, username, password). Run this SQL in your MySQL tool (e.g., phpMyAdmin or console):  
> 
> ```sql:disable-run
> CREATE DATABASE IF NOT EXISTS user_db;
> USE user_db;
> CREATE TABLE IF NOT EXISTS users (
>     id INT AUTO_INCREMENT PRIMARY KEY,
>     name VARCHAR(255) NOT NULL,
>     email VARCHAR(255) NOT NULL UNIQUE
> );
> ```  
> This ensures the `users` table is ready for CRUD operations. If you encounter connection errors, verify your MySQL setup and credentials.

## 📌 تاریخچه کامیت‌ها (persian)
### ✅ کامیت 1 – Add basic user management, create and save new user in txt file (no database)
فایل تک `index.php` ایجاد شد که شامل فرمی ساده برای افزودن کاربر (نام و ایمیل) و جدولی برای نمایش کاربران از `users.txt` است. کاربران جدید به انتهای فایل الحاق می‌شوند.
---
### ✅ کامیت ۲ – Add delete option for users in txt file
قابلیت حذف از طریق لینک‌های GET در جدول (`?delete=index`) اضافه شد. اسکریپت خطوط فایل را می‌خواند، خط هدف را حذف کرده و فایل را بازنویسی می‌کند. ستون "action" و دیالوگ تأیید برای ایمنی کاربر اضافه گردید.
---
### ✅ کامیت ۳ – Add edit option for users in txt file
پشتیبانی ویرایش با لینک‌های GET (`?edit=index`) که فرم را با داده‌های کاربر پر می‌کند، اضافه شد. مدیریت POST بین افزودن و ویرایش با `edit_index` مخفی تمایز داده می‌شود. فایل خوانده شده، خط هدف به‌روزرسانی و بازنویسی می‌گردد. عنوان و دکمه‌های فرم به‌صورت پویا تغییر می‌کنند (add/update).
---
### ✅ کامیت ۴ – Code rewritten and user management logic moved to separate PHP files for better maintainability
کد بازنویسی و منطق مدیریت کاربر به فایل‌های PHP جداگانه منتقل شد برای نگهداری بهتر. فایل‌های `add.php` (مدیریت POST برای کاربران جدید)، `delete.php` (مدیریت GET برای حذف)، `edit.php` (مدیریت POST برای به‌روزرسانی) و `functions.php` (تعریف توابع کمکی `getUsers` و `saveUsers`) اضافه گردید. `index.php` ویرایش شد تا از این فایل‌ها استفاده کند و فرم‌ها را به‌صورت پویا (حالت افزودن/ویرایش) مدیریت نماید.
---
### ✅ کامیت ۵ – Separating the user editing and adding sections from the index file and transferring them to independent files
فرم‌های افزودن و ویرایش کاربر کاملاً از `index.php` جدا و به فایل‌های مستقل منتقل شد: `add_form.php` (فرم HTML ساده برای کاربران جدید) و `edit_form.php` (فرم PHP که داده‌های کاربر را از طریق GET `?edit=index` بارگذاری می‌کند و وجود کاربر را اعتبارسنجی می‌نماید). `index.php` حالا صرفاً لیست کاربران را نمایش می‌دهد با لینک مستقیم به این فرم‌ها. نقاط انتهایی پردازش (`add.php`، `edit.php`) و `delete.php` بدون تغییر برای مدیریت ارسال‌ها و حذف‌ها باقی ماند.
---
### ✅ کامیت ۶ – Code optimization, refactoring, and moving logic into functions
کد بهینه‌سازی و بازنویسی شد برای کارایی و خوانایی بهتر. فایل‌های فرم جداگانه (`add_form.php`، `edit_form.php`) و `delete.php` حذف گردید؛ فرم‌ها حالا مستقیماً در `add.php` (مدیریت نمایش و پردازش POST با پیام خطا) و `edit.php` (مدیریت GET برای بارگذاری/پر کردن و POST برای به‌روزرسانی) ادغام شده‌اند. منطق حذف به `index.php` از طریق مدیریت GET منتقل شد. `functions.php` با توابع CRUD اختصاصی بهبود یافت: `addUser`، `editUser`، `deleteUser` (با بازایندکسینگ آرایه در حذف).
---
### ✅ کامیت ۷ – Migrate user storage from txt file to mysql database using pdo
ذخیره‌سازی فایل txt با پایگاه داده MySQL با استفاده از PDO برای کوئری‌های امن جایگزین شد. `functions.php` حالا شامل تنظیم اتصال PDO (با مدیریت خطا) و توابع CRUD بروزشده (`getUsers`، `addUser`، `editUser`، `deleteUser`) با prepared statements است. `add.php` و `edit.php` هم نمایش/پردازش فرم و تعاملات PDO را مدیریت می‌کنند (با گرفتن exception و چک null). `index.php` از IDهای دیتابیس برای عملیات استفاده کرده و اعتبارسنجی اتصال را شامل می‌شود. نیاز به MySQL با جدول `users` (id AUTO_INCREMENT PRIMARY KEY، name VARCHAR(255)، email VARCHAR(255) UNIQUE) دارد.
---

## 📌 فلش‌بک به کامیت ۷ 
> **راهنمای تنظیم دیتابیس**  
> برای مهاجرت به MySQL، ابتدا دیتابیس و جدول را ایجاد کنید. اطلاعات اتصال دیتابیس (host، dbname، username، password) را در `functions.php` به‌روزرسانی نمایید. این SQL را در ابزار MySQL خود (مانند phpMyAdmin یا کنسول) اجرا کنید:  
> 
> ```sql
> CREATE DATABASE IF NOT EXISTS user_db;
> USE user_db;
> CREATE TABLE IF NOT EXISTS users (
>     id INT AUTO_INCREMENT PRIMARY KEY,
>     name VARCHAR(255) NOT NULL,
>     email VARCHAR(255) NOT NULL UNIQUE
> );
> ```  
> این کار جدول `users` را برای عملیات CRUD آماده می‌کند. در صورت بروز خطای اتصال، تنظیمات MySQL و اطلاعات اعتبارسنجی را بررسی کنید.
```

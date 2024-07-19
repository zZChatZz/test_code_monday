# Welcome 
โปรเจกต์นี้เป็นการจัดการ Category แบบ Tree โดยใช้ Laravel V10


# เครื่องมือที่เกี่ยวข้อง
Git [Download](https://git-scm.com/downloads)
Composer [Download](https://getcomposer.org/download/)
Xampp [Download](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe/download)


# วิธีติดตั้ง

1. Clone Project ลงบนเครื่อง `git clone https://github.com/chut1382538/test_code_monday.git`
2. เข้าไปที่โฟลเดอร์ test_code_monday ที่ติดตั้ง `cd test_code_monday`
3. Copy ไฟล์ .env.example เป็นชื่อ .env `copy .env.example .env`
4. ตั้งค่า ฐานข้อมูลที่ต้องการใช้งานที่ไฟล์ .env 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_code_monday
DB_USERNAME=root
DB_PASSWORD=
```
5. เปิด Xampp และ Start MySQL
6. Run คำสั่ง
```
composer install
php artisan key:generate --ansi
php artisan migrate --force
php artisan db:seed
php artisan passport:install
```

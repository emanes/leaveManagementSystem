<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Leave Management System
Leave Management System is a web application built on the Laravel framework (v11), designed for managing employee leave requests. Within this system, employees can submit leave applications, which are then reviewed and processed by the Admin. Upon approval or rejection of a leave application, the requester receives a notification via email.

## Features

- User Authentication
- User Roles (Admin, Employee)
- Update user profile
- Employee Dashboard 
  - View leave statistics
  - Submit leave application
  - View leave history
  - edit or delete leave application
- Admin Dashboard
  - Admin User Management
      - View all users
      - Accept new employee registrations
      - Block or unblock users
  - Leave Application Management
    - View all leave applications
    - Approve or reject leave applications
    - View leave application statistics
- Email Notifications
  (Notify user of leave application submission , approval or rejection)
    
## Installation
01. `git clone https://github.com/emanes/leaveManagementSystem.git`
02. `cd leave-management-system`
03. `composer update`
04. `cp .env.example .env`
05. `php artisan key:generate`
06. `php artisan migrate:fresh --seed`
07. `php artisan serve`

## Test Users Admin
email               | password
-----------------   |---------
admin@test.com   | Admin@123

## Test Users Employe
email               | password
-----------------   |---------
oosbourne@test.com     | Pass@12345
ayoung@test.com     | Pass@12345 
dlombardo@test.com     | Pass@12345

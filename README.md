<p align="center">
    <a href="https://github.com/emanes" target="_blank">
        <img src="https://avatars.githubusercontent.com/u/14974544?v2" alt="Emilio Manes">
    </a>
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

1. `git clone https://github.com/emanes/leaveManagementSystem.git`
2. `cd leaveManagementSystem`
3. `cp .env.example .env`


### Dependencies

1. `composer update`
2. `npm i`

### Docker
#### Run
```
docker compose up -d
```
#### Stop
```
docker compose stop
```
#### Connect to container
```
docker exec -it manes_lvm_app sh
```
or
```
docker exec -it manes_lvm_app /bin/sh
```

### Laravel Key Generate, DB Migration, DB Seed
1. `php artisan key:generate`
2. `php artisan php artisan migrate`
3. `php artisan db:seed`


## Test Users Admin
email               | password
-----------------   |---------
admin@test.com   | Admin@123

## Test Users Employee
email               | password
-----------------   |---------
oosbourne@test.com     | Test@12345
ayoung@test.com     | Test@12345 
dlombardo@test.com     | Test@12345


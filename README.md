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

## Stack
 - Php v8
 - Laravel Framework 11
 - Blade
 - Docker
   - nginx:1.25-alpine
   - mysql:8.0
   - mailpit
    
## Installation

1. `git clone https://github.com/emanes/leaveManagementSystem.git`
2. `cd leaveManagementSystem`
3. `cp .env.example .env`
4. `composer update`
5. `php artisan key:generate`
6. `npm i`

### Docker
#### Run
7. `docker compose up -d`

#### Connect to container
8. `docker exec -it manes_lvm_app sh` or `docker exec -it manes_lvm_app /bin/sh`

#### DB Migration, DB Seed
*\*\*Run the following two commands in the docker container 'manes_lvm_app' terminal*

9. `php artisan migrate`
10. `php artisan db:seed`

#### Run Npm
11. `npm run dev`


## Enjoy
### Test Users Admin
- usr: `admin@test.com` | pwd: `Admin@123`

### Test Users Employee
- usr: `oosbourne@test.com` | pwd: `Test@12345`
- usr: `ayoung@test.com` | pwd: `Test@12345`
- usr: `dlombardo@test.com` | pwd: `Test@12345`


### Web View
 - App: http://localhost:8000/
 - Mailpit: http://localhost:8025/

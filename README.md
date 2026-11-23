Membership Management and Transaction Processing System
A Laravel-based web application for managing members, membership applications, transactions, payments, and assigned tasks.
Features
Admin Features
- Admin dashboard
- Member management
- Membership categories and levels
- Membership registration and application review
- Member activation and deactivation
- Transaction and payment management
- Membership approval
- Task assignment and monitoring
- Email notifications
Member Features
- Member registration
- Email verification
- Member dashboard
- View membership status and validity dates
- View membership category and level
- View transaction and payment history
- View assigned tasks
- Update task progress: Pending, In Progress, and Completed
- View task descriptions and admin notes
- Secure member-only access

User Roles and Permissions
Administrator
Administrators can manage members, membership categories, membership levels, transactions, payments, and assigned tasks. They can also approve membership applications and monitor member activity.
Member
Members can access only their own dashboard, membership details, transactions, payments, and assigned tasks. Members can start and complete only the tasks assigned to their own account.

Members cannot access admin pages or modify another member's information.
Technology Stack
- Laravel 12
- PHP 8.2 or higher
- MySQL
- Blade Templates
- HTML and CSS
- JavaScript
- Laravel Breeze Authentication
- Gmail SMTP for email notifications
System Requirements
- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL
- XAMPP or another local PHP development environment
- Gmail account with an App Password for email testing

Installation
1. Install dependencies
composer install
npm install
2. Create the environment file
Copy .env.example and rename the copy to .env.
3. Generate the application key
php artisan key:generate
4. Configure the database
Create a MySQL database and update .env:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tw31_tasks
DB_USERNAME=root
DB_PASSWORD=

5. Run migrations
php artisan migrate
If seeders are available:
php artisan migrate --seed
Environment Configuration
Example application settings:
APP_NAME="Membership Management System"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
Do not commit .env to a public repository because it may contain private credentials.
Email Configuration
The system uses email verification and email notifications for membership-related activities.

Example Gmail SMTP settings:
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=adminnn98@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="adminnn98@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

For Gmail, use a Gmail App Password instead of the regular Gmail password. Never include passwords, App Passwords, API keys, or private tokens in this README or in a public repository.

After changing the mail configuration, run:
php artisan optimize:clear

Registration and Membership Workflow
1. A member registers an account.
2. The system creates a pending membership application and transaction.
3. A verification email is sent to the member.
4. The member verifies the email address.
5. The member waits for admin approval.
6. The administrator records the payment and approves the application.
7. The membership becomes active and the member receives an approval notification.
Email verification confirms the member's email address. It does not automatically activate the membership. The membership remains pending until it is approved by the administrator.

Task Workflow
Pending → In Progress → Completed
- Pending – The task has not been started.
- In Progress – The member has started working on the task.
- Completed – The member has finished the task.

Members can update only tasks assigned to their own member account.
Running the Application
php artisan serve
The application is usually available at:
http://127.0.0.1:8000
In another terminal, run:
npm run dev
Important Routes
Authentication
/register
/login
/verify-email
/forgot-password
Admin
/dashboard
/members
/tasks
/membership-categories
/membership-levels
/transactions
/payments
/task-dashboard
Member
/member/dashboard
/member/tasks
/member/transactions
/member/tasks/{task}/start
/member/tasks/{task}/complete
Member routes are protected by authentication and email verification middleware.
Testing Documentation
Email functionality was tested using Gmail with masked test accounts.
Test	Email Used	Expected Result	Status
Member registration email	m*****@gmail.com	Verification email is received	Passed
Email verification	m*****@gmail.com	Member is redirected to the member dashboard	Passed
Resend verification email	m*****@gmail.com	A new verification email is sent	Passed
Membership approval email	m*****@gmail.com	Member receives an approval notification	Passed


The real email address and email credentials are not included for privacy and security.
Security Features
- Laravel Breeze authentication
- Email verification
- Role-based access control
- Admin middleware
- Member-only route protection
- Task ownership validation
- CSRF protection
- Password hashing
- Request validation
- Protected environment configuration
Project Structure
app/
├── Http/Controllers/
│   ├── Auth/
│   ├── DashboardController.php
│   ├── MemberController.php
│   ├── MembershipCategoryController.php
│   ├── MembershipLevelController.php
│   ├── PaymentController.php
│   ├── TaskController.php
│   └── TransactionController.php
├── Models/
│   ├── Member.php
│   ├── MembershipCategory.php
│   ├── MembershipLevel.php
│   ├── MembershipTransaction.php
│   ├── Payment.php
│   ├── Task.php
│   └── User.php
└── Notifications/

database/
├── migrations/
├── seeders/
└── factories/

resources/views/
├── auth/
├── layouts/
├── member/
├── members/
└── ...

routes/
├── web.php
└── auth.php
Troubleshooting
Application key error
php artisan key:generate
Database connection error
Check the database values in .env and make sure MySQL is running.
Email was not received
Check that the email address is correct, the message is not in Spam, Gmail SMTP settings are correct, and a Gmail App Password is being used. Then run:
php artisan optimize:clear
Verification page keeps appearing
Check the users table. The email_verified_at column should contain a date and time after successful verification. If it is NULL, the email has not been verified.
Member receives an admin access error
Make sure the member is using /member/dashboard, the user's role is member, and the member is not accessing an admin-only route.
Route is not defined
List all registered routes:
php artisan route:list
Confirm that the route name used in the Blade file matches the route name in routes/web.php.
Credits
This project was developed as an educational Laravel system for membership management, transaction processing, payment monitoring, email verification, and task tracking.

Built with Laravel, PHP, MySQL, Blade, CSS, and Laravel Breeze.
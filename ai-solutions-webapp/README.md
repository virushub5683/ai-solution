# AI-Solutions Web Application

AI-Solutions is a PHP, MySQL, HTML, CSS, and JavaScript web application for customer engagement, service information, demo scheduling, contact enquiries, and Gemini AI chatbot support.

## Main Features

- Landing page with six customer function buttons and editable content.
- Contact/enquiry form protected by Google reCAPTCHA v2.
- Product demo scheduling form.
- Gemini AI chatbot with per-session conversation history saved in MySQL.
- Admin login page protected by Google reCAPTCHA v2.
- Admin dashboard for managing the six function buttons, enquiries, demo bookings, and chatbot sessions.
- No admin button or admin link is shown on the landing page. Open the admin area directly at `/admin/login.php`.

## Technology Used

- HTML
- CSS
- JavaScript
- PHP
- MySQL
- XAMPP
- Visual Studio Code
- Gemini API
- Google reCAPTCHA v2

## Default Admin Login

The default admin credentials are stored in `.env`:

- Email: `admin@aisolutions.local`
- Password: `Admin@12345`

Change these before using the project for real data.

## Project Paths

Place the whole `ai-solutions-webapp` folder inside your XAMPP `htdocs` folder. The public website starts from:

`http://localhost/ai-solutions-webapp/public/`

The admin page is direct access only:

`http://localhost/ai-solutions-webapp/admin/login.php`

## Database

Import `database/schema.sql` into MySQL/phpMyAdmin. It creates the database, tables, and six default function buttons.

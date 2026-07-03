# Simple Setup Guidance

1. Install and open XAMPP.
2. Start Apache and MySQL.
3. Copy the `ai-solutions-webapp` folder into `C:\xampp\htdocs`.
4. Open phpMyAdmin at `http://localhost/phpmyadmin`.
5. Import `database/schema.sql`.
6. Open `.env` and add your Gemini API key plus Google reCAPTCHA v2 site key and secret key.
7. Open the website at `http://localhost/ai-solutions-webapp/public/`.
8. Open the admin page directly at `http://localhost/ai-solutions-webapp/admin/login.php`.

Important: the landing page intentionally does not include an admin button or admin link.

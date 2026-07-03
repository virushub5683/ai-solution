<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/recaptcha.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_recaptcha()) {
        $error = 'Please complete the captcha.';
    } elseif (($_POST['email'] ?? '') === ADMIN_EMAIL && ($_POST['password'] ?? '') === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid admin login details.';
    }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Login</title><link rel="stylesheet" href="../public/assets/css/style.css"><script src="https://www.google.com/recaptcha/api.js" async defer></script></head><body><main class="section narrow"><div class="section-heading"><p class="eyebrow">Direct admin page</p><h1>Admin login</h1><p>This page is intentionally not linked from the landing page.</p></div><?php if ($error): ?><p class="notice error"><?= e($error) ?></p><?php endif; ?><form class="panel" method="post"><input type="email" name="email" placeholder="Admin email" required><input type="password" name="password" placeholder="Password" required><?= recaptcha_widget() ?><button class="btn primary" type="submit">Login</button></form></main></body></html>

<?php
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/recaptcha.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: contact.php'); exit; }
if (!verify_recaptcha()) { header('Location: contact.php?error=' . urlencode('Please complete the captcha.')); exit; }
$stmt = db()->prepare('INSERT INTO enquiries (full_name,email,phone,company,subject,message) VALUES (?,?,?,?,?,?)');
$stmt->execute([$_POST['full_name'], $_POST['email'], $_POST['phone'] ?? null, $_POST['company'] ?? null, $_POST['subject'], $_POST['message']]);
header('Location: contact.php?sent=1');

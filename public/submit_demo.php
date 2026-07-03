<?php
require_once __DIR__ . '/../includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: index.php'); exit; }
$stmt = db()->prepare('INSERT INTO demo_bookings (full_name,email,phone,company,demo_topic,preferred_date,preferred_time,notes) VALUES (?,?,?,?,?,?,?,?)');
$stmt->execute([$_POST['full_name'], $_POST['email'], $_POST['phone'] ?? null, $_POST['company'] ?? null, $_POST['demo_topic'], $_POST['preferred_date'], $_POST['preferred_time'], $_POST['notes'] ?? null]);
header('Location: index.php?demo=sent#services');

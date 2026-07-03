<?php require_once __DIR__ . '/layout.php';
$stats = [
 'functions' => db()->query('SELECT COUNT(*) c FROM function_buttons')->fetch()['c'],
 'enquiries' => db()->query('SELECT COUNT(*) c FROM enquiries')->fetch()['c'],
 'demos' => db()->query('SELECT COUNT(*) c FROM demo_bookings')->fetch()['c'],
]; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Dashboard</title><link rel="stylesheet" href="../public/assets/css/style.css"></head><body><div class="admin-layout"><aside class="sidebar"><h2>AI Admin</h2><a href="dashboard.php">Dashboard</a><a href="functions.php">Function Buttons</a><a href="enquiries.php">Enquiries</a><a href="demos.php">Demo Bookings</a><a href="chats.php">Chat History</a><a href="logout.php">Logout</a></aside><main class="admin-main"><h1>Dashboard</h1><div class="stats"><div class="stat"><strong><?= e($stats['functions']) ?></strong><p>Function buttons</p></div><div class="stat"><strong><?= e($stats['enquiries']) ?></strong><p>Enquiries</p></div><div class="stat"><strong><?= e($stats['demos']) ?></strong><p>Demo bookings</p></div></div></main></div></body></html>

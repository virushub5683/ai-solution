<?php
require_once __DIR__ . '/../includes/config.php';
unset($_SESSION['admin_logged_in']);
header('Location: login.php');

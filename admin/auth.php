<?php
require_once __DIR__ . '/../includes/functions.php';
function require_admin(): void
{
    if (empty($_SESSION['admin_logged_in'])) {
        header('Location: login.php');
        exit;
    }
}

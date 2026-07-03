<?php
require_once __DIR__ . '/config.php';

function verify_recaptcha(): bool
{
    if (!RECAPTCHA_SECRET_KEY || str_contains(RECAPTCHA_SECRET_KEY, 'PASTE_')) {
        return true;
    }
    $token = $_POST['g-recaptcha-response'] ?? '';
    if (!$token) {
        return false;
    }
    $payload = http_build_query([
        'secret' => RECAPTCHA_SECRET_KEY,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? null,
    ]);
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded
",
            'content' => $payload,
            'timeout' => 10,
        ],
    ]);
    $response = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
    if ($response === false) {
        return false;
    }
    $data = json_decode($response, true);
    return !empty($data['success']);
}

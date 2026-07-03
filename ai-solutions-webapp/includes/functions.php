<?php
require_once __DIR__ . '/db.php';

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function active_function_buttons(): array
{
    $stmt = db()->query('SELECT * FROM function_buttons WHERE is_active = 1 ORDER BY button_order ASC, id ASC LIMIT 6');
    return $stmt->fetchAll();
}

function all_function_buttons(): array
{
    $stmt = db()->query('SELECT * FROM function_buttons ORDER BY button_order ASC, id ASC');
    return $stmt->fetchAll();
}

function recaptcha_widget(): string
{
    if (!RECAPTCHA_SITE_KEY || str_contains(RECAPTCHA_SITE_KEY, 'PASTE_')) {
        return '<p class="captcha-note">Add Google reCAPTCHA v2 keys in .env to enable verification.</p>';
    }
    return '<div class="g-recaptcha" data-sitekey="' . e(RECAPTCHA_SITE_KEY) . '"></div>';
}

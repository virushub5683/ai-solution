<?php
function load_env(string $path): array
{
    $env = [];
    if (!file_exists($path)) {
        return $env;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $value = trim($value);

        if (strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        $env[trim($key)] = $value;
    }

    return $env;
}

$env = load_env(dirname(__DIR__) . '/.env');

define('APP_NAME', $env['APP_NAME'] ?? 'AI-Solutions');
define('APP_URL', rtrim($env['APP_URL'] ?? 'http://localhost/ai-solutions-webapp/public', '/'));
define('DB_HOST', $env['DB_HOST'] ?? '127.0.0.1');
define('DB_PORT', $env['DB_PORT'] ?? '3306');
define('DB_NAME', $env['DB_NAME'] ?? 'ai_solutions');
define('DB_USER', $env['DB_USER'] ?? 'root');
define('DB_PASS', $env['DB_PASS'] ?? '');
define('ADMIN_EMAIL', $env['ADMIN_EMAIL'] ?? 'admin@aisolutions.local');
define('ADMIN_PASSWORD', $env['ADMIN_PASSWORD'] ?? 'Admin@12345');
define('GEMINI_API_KEY', $env['GEMINI_API_KEY'] ?? '');
define('GEMINI_MODEL', $env['GEMINI_MODEL'] ?? 'gemini-1.5-flash');
define('RECAPTCHA_SITE_KEY', $env['RECAPTCHA_SITE_KEY'] ?? '');
define('RECAPTCHA_SECRET_KEY', $env['RECAPTCHA_SECRET_KEY'] ?? '');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

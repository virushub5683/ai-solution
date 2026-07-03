<?php
require_once __DIR__ . '/db.php';

function chat_session_key(): string
{
    if (empty($_SESSION['chat_session_key'])) {
        $_SESSION['chat_session_key'] = bin2hex(random_bytes(24));
    }
    $key = $_SESSION['chat_session_key'];
    $stmt = db()->prepare('INSERT IGNORE INTO chat_sessions (session_key) VALUES (?)');
    $stmt->execute([$key]);
    return $key;
}

function save_chat_message(string $sessionKey, string $role, string $message): void
{
    $stmt = db()->prepare('INSERT INTO chat_messages (session_key, role, message) VALUES (?, ?, ?)');
    $stmt->execute([$sessionKey, $role, $message]);
}

function chat_history(string $sessionKey, int $limit = 12): array
{
    $stmt = db()->prepare('SELECT role, message FROM chat_messages WHERE session_key = ? ORDER BY id DESC LIMIT ' . (int)$limit);
    $stmt->execute([$sessionKey]);
    return array_reverse($stmt->fetchAll());
}

function gemini_reply(string $sessionKey, string $question): string
{
    $history = chat_history($sessionKey, 10);
    $contents = [];
    $contents[] = [
        'role' => 'user',
        'parts' => [[
            'text' => 'You are the AI-Solutions website assistant. Give helpful, specific answers about AI consulting, automation, demos, events, enquiries, and customer support. Use the conversation history and avoid one-sentence answers unless the user clearly asks for a short answer.'
        ]]
    ];
    foreach ($history as $item) {
        $contents[] = [
            'role' => $item['role'] === 'assistant' ? 'model' : 'user',
            'parts' => [['text' => $item['message']]],
        ];
    }
    $contents[] = ['role' => 'user', 'parts' => [['text' => $question]]];

    if (!GEMINI_API_KEY || str_contains(GEMINI_API_KEY, 'PASTE_')) {
        return 'Gemini is ready to be connected. Add your Gemini API key in the .env file. For now, I can still help explain AI-Solutions services, demo scheduling, enquiries, and events based on the website content.';
    }

    $url = 'https://generativelanguage.googleapis.com/v1beta/models/' . rawurlencode(GEMINI_MODEL) . ':generateContent?key=' . rawurlencode(GEMINI_API_KEY);
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/json
",
            'content' => json_encode(['contents' => $contents]),
            'timeout' => 20,
        ],
    ]);
    $response = @file_get_contents($url, false, $context);
    if ($response === false) {
        return 'I could not reach Gemini at the moment. Please check the API key and internet connection, then try again.';
    }
    $data = json_decode($response, true);
    return trim($data['candidates'][0]['content']['parts'][0]['text'] ?? 'I could not generate a clear reply. Please rephrase your question.');
}

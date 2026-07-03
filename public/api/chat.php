<?php
require_once __DIR__ . '/../../includes/gemini.php';
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);
$question = trim($input['message'] ?? '');
if ($question === '') { echo json_encode(['reply' => 'Please type a question so I can help.']); exit; }
$key = chat_session_key();
save_chat_message($key, 'user', $question);
$reply = gemini_reply($key, $question);
save_chat_message($key, 'assistant', $reply);
echo json_encode(['reply' => $reply]);

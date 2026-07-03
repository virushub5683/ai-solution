<?php require_once __DIR__ . '/layout.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['buttons'] ?? [] as $id => $b) {
        $stmt = db()->prepare('UPDATE function_buttons SET title=?, summary=?, content=?, button_order=?, is_active=? WHERE id=?');
        $stmt->execute([$b['title'], $b['summary'], $b['content'], (int)$b['button_order'], isset($b['is_active']) ? 1 : 0, (int)$id]);
    }
    header('Location: functions.php?saved=1'); exit;
}
$buttons = all_function_buttons(); ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Manage Functions</title><link rel="stylesheet" href="../public/assets/css/style.css"></head><body><div class="admin-layout"><aside class="sidebar"><h2>AI Admin</h2><a href="dashboard.php">Dashboard</a><a href="functions.php">Function Buttons</a><a href="enquiries.php">Enquiries</a><a href="demos.php">Demo Bookings</a><a href="chats.php">Chat History</a><a href="logout.php">Logout</a></aside><main class="admin-main"><div class="toolbar"><h1>Manage six function buttons</h1></div><?php if (!empty($_GET['saved'])): ?><p class="notice success">Saved.</p><?php endif; ?><form method="post"><?php foreach ($buttons as $b): ?><section class="panel"><input name="buttons[<?= e($b['id']) ?>][title]" value="<?= e($b['title']) ?>" required><input name="buttons[<?= e($b['id']) ?>][summary]" value="<?= e($b['summary']) ?>" required><textarea name="buttons[<?= e($b['id']) ?>][content]" required><?= e($b['content']) ?></textarea><input type="number" name="buttons[<?= e($b['id']) ?>][button_order]" value="<?= e($b['button_order']) ?>"><label><input type="checkbox" name="buttons[<?= e($b['id']) ?>][is_active]" <?= $b['is_active'] ? 'checked' : '' ?>> Active</label></section><?php endforeach; ?><button class="btn primary">Save changes</button></form></main></div></body></html>

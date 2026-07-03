<?php require_once __DIR__ . '/../includes/functions.php'; $buttons = active_function_buttons(); ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e(APP_NAME) ?> | Customer Engagement</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
  <a class="brand" href="index.php"><span>AI</span> Solutions</a>
  <nav>
    <a href="#services">Services</a>
    <a href="contact.php">Contact</a>
  </nav>
</header>
<main>
  <section class="hero">
    <div>
      <p class="eyebrow">AI-powered business support</p>
      <h1>Customer engagement and demo scheduling for AI-Solutions</h1>
      <p>Explore services, ask the chatbot questions, submit enquiries, and request product demonstrations from one simple web application.</p>
      <div class="hero-actions">
        <a class="btn primary" href="#services">Explore functions</a>
        <a class="btn ghost" href="contact.php">Contact us</a>
      </div>
    </div>
  </section>
  <section id="services" class="section">
    <div class="section-heading">
      <p class="eyebrow">Six functions</p>
      <h2>What customers can do</h2>
    </div>
    <div class="function-grid">
      <?php foreach ($buttons as $button): ?>
      <article class="function-card">
        <div class="icon"><?= e(strtoupper(substr($button['title'], 0, 2))) ?></div>
        <h3><?= e($button['title']) ?></h3>
        <p><?= e($button['summary']) ?></p>
        <details>
          <summary>View content</summary>
          <p><?= nl2br(e($button['content'])) ?></p>
        </details>
      </article>
      <?php endforeach; ?>
    </div>
  </section>
  <section class="split section">
    <div>
      <h2>Schedule a product demonstration</h2>
      <p>Choose the solution you want to see and the preferred date and time. The AI-Solutions team will review the request in the admin dashboard.</p>
    </div>
    <form class="panel" method="post" action="submit_demo.php">
      <input name="full_name" placeholder="Full name" required>
      <input type="email" name="email" placeholder="Email address" required>
      <input name="phone" placeholder="Phone number">
      <input name="company" placeholder="Company">
      <select name="demo_topic" required>
        <option value="">Choose demo topic</option>
        <?php foreach ($buttons as $button): ?><option><?= e($button['title']) ?></option><?php endforeach; ?>
      </select>
      <div class="two-cols"><input type="date" name="preferred_date" required><input type="time" name="preferred_time" required></div>
      <textarea name="notes" placeholder="Notes or questions"></textarea>
      <button class="btn primary" type="submit">Request demo</button>
    </form>
  </section>
</main>
<div class="chat-widget" id="chatWidget">
  <button class="chat-toggle" type="button" id="chatToggle">AI Chat</button>
  <div class="chat-panel" id="chatPanel" hidden>
    <div class="chat-header"><strong>Gemini Assistant</strong><button id="chatClose" type="button">x</button></div>
    <div class="chat-messages" id="chatMessages"></div>
    <form id="chatForm" class="chat-form"><input id="chatInput" placeholder="Ask about services or demos" required><button>Send</button></form>
  </div>
</div>
<footer>© <?= date('Y') ?> AI-Solutions</footer>
<script src="assets/js/main.js"></script>
</body>
</html>

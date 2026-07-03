<?php require_once __DIR__ . '/../includes/functions.php'; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Contact | <?= e(APP_NAME) ?></title><link rel="stylesheet" href="assets/css/style.css"><script src="https://www.google.com/recaptcha/api.js" async defer></script></head>
<body><header class="site-header"><a class="brand" href="index.php"><span>AI</span> Solutions</a><nav><a href="index.php#services">Services</a><a href="contact.php">Contact</a></nav></header>
<main class="section narrow"><div class="section-heading"><p class="eyebrow">Contact</p><h1>Send an enquiry</h1><p>Your message is stored for the admin team to manage.</p></div>
<?php if (!empty($_GET['sent'])): ?><p class="notice success">Thank you. Your enquiry has been submitted.</p><?php endif; ?>
<?php if (!empty($_GET['error'])): ?><p class="notice error"><?= e($_GET['error']) ?></p><?php endif; ?>
<form class="panel" method="post" action="submit_contact.php">
<input name="full_name" placeholder="Full name" required><input type="email" name="email" placeholder="Email address" required><input name="phone" placeholder="Phone number"><input name="company" placeholder="Company"><input name="subject" placeholder="Subject" required><textarea name="message" placeholder="Message" required></textarea><?= recaptcha_widget() ?><button class="btn primary" type="submit">Submit enquiry</button>
</form></main><footer>© <?= date('Y') ?> AI-Solutions</footer></body></html>

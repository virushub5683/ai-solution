CREATE DATABASE IF NOT EXISTS ai_solutions CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ai_solutions;

CREATE TABLE IF NOT EXISTS function_buttons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(120) NOT NULL,
  icon VARCHAR(40) NOT NULL DEFAULT 'spark',
  summary VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  button_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS enquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL,
  phone VARCHAR(60) DEFAULT NULL,
  company VARCHAR(160) DEFAULT NULL,
  subject VARCHAR(180) NOT NULL,
  message TEXT NOT NULL,
  status ENUM('new','read','closed') NOT NULL DEFAULT 'new',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS demo_bookings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL,
  phone VARCHAR(60) DEFAULT NULL,
  company VARCHAR(160) DEFAULT NULL,
  demo_topic VARCHAR(160) NOT NULL,
  preferred_date DATE NOT NULL,
  preferred_time TIME NOT NULL,
  notes TEXT DEFAULT NULL,
  status ENUM('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS chat_sessions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_key VARCHAR(128) NOT NULL UNIQUE,
  visitor_label VARCHAR(120) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS chat_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  session_key VARCHAR(128) NOT NULL,
  role ENUM('user','assistant') NOT NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX(session_key)
);

INSERT INTO function_buttons (title, icon, summary, content, button_order, is_active) VALUES
('AI Consulting', 'brain', 'Plan practical AI adoption for your business.', 'Our consultants review your business process, identify AI opportunities, and prepare a clear adoption roadmap with risk, cost, and benefit guidance.', 1, 1),
('Automation Solutions', 'gear', 'Reduce repeated manual work.', 'We design automation workflows for enquiries, reporting, customer follow-up, and internal business tasks so teams can focus on higher-value work.', 2, 1),
('Demo Scheduling', 'calendar', 'Book a product demonstration.', 'Customers can request a demonstration of AI-powered tools and choose a preferred date and time for the AI-Solutions team to follow up.', 3, 1),
('Customer Engagement', 'chat', 'Improve customer communication.', 'AI-Solutions provides enquiry handling, chatbot support, and contact management to help customers receive faster and more consistent responses.', 4, 1),
('Events Registration', 'ticket', 'Register interest in promotions and events.', 'Visitors can register interest in promotional events, webinars, and product showcases run by AI-Solutions.', 5, 1),
('Analytics Reports', 'chart', 'View business insight and activity trends.', 'The admin dashboard supports business analysis by displaying enquiries, demos, and customer interaction information for decision making.', 6, 1)
ON DUPLICATE KEY UPDATE title = VALUES(title);

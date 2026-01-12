-- Initialize database
CREATE DATABASE IF NOT EXISTS rescuenet CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create user and grant privileges
GRANT ALL PRIVILEGES ON rescuenet.* TO 'rescuenet'@'%';
FLUSH PRIVILEGES;

USE rescuenet;

-- Additional initialization queries can be added here

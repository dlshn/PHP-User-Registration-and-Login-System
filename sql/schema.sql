
-- Create the database
CREATE DATABASE IF NOT EXISTS register;

-- Use the created database
USE register;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT(255) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create indexes
CREATE INDEX email_index ON users(email);

-- สร้าง Database และตาราง users สำหรับระบบ GLIN
CREATE DATABASE IF NOT EXISTS glin CHARACTER SET utf8 COLLATE utf8_general_ci;

USE glin;

CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    name       VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);

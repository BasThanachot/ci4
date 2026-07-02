-- ตารางระบบเอกสารจัดซื้อ-จัดจ้าง (ต่อยอดจากฐานข้อมูลเดิมของโปรเจกต์)
-- รันไฟล์นี้บนฐานข้อมูล Ci (ตามค่าใน application/config/database.php)

USE `Ci`;

CREATE TABLE IF NOT EXISTS procurement_categories (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) NOT NULL,
    icon        VARCHAR(60)  DEFAULT 'ti-folder',
    color       VARCHAR(20)  DEFAULT '#EAF3DE',
    icon_color  VARCHAR(20)  DEFAULT '#3B6D11',
    sort_order  INT          DEFAULT 0,
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS procurement_sub1 (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    category_id  INT NOT NULL,
    name         VARCHAR(255) NOT NULL,
    sort_order   INT DEFAULT 0,
    created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (category_id)
);

CREATE TABLE IF NOT EXISTS procurement_sub2 (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    sub1_id     INT NOT NULL,
    name        VARCHAR(255) NOT NULL,
    sort_order  INT DEFAULT 0,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (sub1_id)
);

-- รายการเอกสาร: เก็บ "content" เป็นข้อความที่แก้ไขได้โดยตรง แทนการแนบไฟล์
CREATE TABLE IF NOT EXISTS procurement_items (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    sub2_id     INT NOT NULL,
    title       VARCHAR(255) NOT NULL,
    content     TEXT,
    sort_order  INT DEFAULT 0,
    updated_by  INT DEFAULT NULL,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX (sub2_id)
);

-- ประวัติการแก้ไขรายการเอกสาร (รูปแบบเดียวกับ user_logs ที่มีอยู่แล้วในระบบ)
CREATE TABLE IF NOT EXISTS procurement_item_logs (
    id                    INT AUTO_INCREMENT PRIMARY KEY,
    item_id               INT NOT NULL,
    target_title          VARCHAR(255) NOT NULL,
    changed_by_id         INT DEFAULT NULL,
    changed_by_username   VARCHAR(50) DEFAULT NULL,
    field                 VARCHAR(50) NOT NULL,
    old_value             TEXT DEFAULT NULL,
    new_value             TEXT DEFAULT NULL,
    created_at            TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX (item_id),
    INDEX (created_at)
);

CREATE TABLE tb_employee (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  gender VARCHAR(1) COMMENT 'M=ชาย, F=หญิง, N=ไม่ระบุ',
  prefix VARCHAR(50),
  first_name VARCHAR(200),
  last_name VARCHAR(200),
  nick_name VARCHAR(100),
  email varchar(100) NOT NULL,
  password VARCHAR(255),
  status VARCHAR(1) COMMENT 'A = active, I = inactive',
  deleted_at datetime,
  created_by varchar(80),
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_by varchar(80),
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY employee_email_uidx_1 (email)
) CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE tb_product_category (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(200),
  deleted_at datetime,
  created_by varchar(80),
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_by varchar(80),
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE tb_product (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  product_category_id BIGINT(20),
  product_code VARCHAR(50),
  product_name VARCHAR(200),
  product_quantity INT,
  deleted_at datetime,
  created_by varchar(80),
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_by varchar(80),
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
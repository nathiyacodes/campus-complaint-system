CREATE DATABASE IF NOT EXISTS smart_campus CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE smart_campus;
CREATE TABLE IF NOT EXISTS users (
 id INT AUTO_INCREMENT PRIMARY KEY, full_name VARCHAR(100) NOT NULL,
 email VARCHAR(150) NOT NULL UNIQUE, college_id VARCHAR(50) UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('student','staff','admin') NOT NULL,
 is_approved TINYINT(1) NOT NULL DEFAULT 0,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS complaints (
 id INT AUTO_INCREMENT PRIMARY KEY, student_id INT NOT NULL,
 title VARCHAR(150) NOT NULL,
 category ENUM('Facilities','Hostel','IT Support','Cleanliness','Safety','Academic','Other') NOT NULL DEFAULT 'Other',
 description TEXT NOT NULL, location VARCHAR(150) DEFAULT NULL,
 priority ENUM('Low','Medium','High','Urgent') NOT NULL DEFAULT 'Medium',
 status ENUM('Submitted','Assigned','In Progress','Resolved','Rejected') NOT NULL DEFAULT 'Submitted',
 assigned_staff_id INT DEFAULT NULL, resolution_note TEXT DEFAULT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY (assigned_staff_id) REFERENCES users(id) ON DELETE SET NULL,
 INDEX idx_student_created(student_id,created_at), INDEX idx_staff_status(assigned_staff_id,status)
) ENGINE=InnoDB;

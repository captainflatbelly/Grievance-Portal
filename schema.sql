-- Create users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    upassword VARCHAR(255) NOT NULL,
    joining_date DATE
);

-- Create staff table
CREATE TABLE staff (
    staff_id INT AUTO_INCREMENT PRIMARY KEY,
    staffname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    upassword VARCHAR(255) NOT NULL,
    joining_date DATE
);

-- Create complaints table
CREATE TABLE complaints (
    C_id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    Mob VARCHAR(20),
    Category VARCHAR(255) NOT NULL,
    Location VARCHAR(255) NOT NULL,
    Priority ENUM('Low', 'Medium', 'High') NOT NULL,
    Description TEXT NOT NULL,
    Reg_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    staff_id INT,
    status ENUM('Pending', 'InProgress', 'Resolved') DEFAULT 'Pending',
    FOREIGN KEY (staff_id) REFERENCES staff(staff_id)
);

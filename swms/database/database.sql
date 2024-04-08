-- Drop existing sequences if they exist
DROP SEQUENCE IF EXISTS residents_seq;
DROP SEQUENCE IF EXISTS waste_personnel_seq;
DROP SEQUENCE IF EXISTS schedule_seq;
DROP SEQUENCE IF EXISTS feedback_seq;
DROP SEQUENCE IF EXISTS missed_pickups_seq;

-- Create sequences
CREATE SEQUENCE residents_seq START WITH 1;
CREATE SEQUENCE waste_personnel_seq START WITH 1;
CREATE SEQUENCE schedule_seq START WITH 1;
CREATE SEQUENCE feedback_seq START WITH 1;
CREATE SEQUENCE missed_pickups_seq START WITH 1;

-- Create residents table
CREATE TABLE IF NOT EXISTS residents (
    id VARCHAR(5) NOT NULL PRIMARY KEY,
    profile_pic MEDIUMBLOB,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    phone_number VARCHAR(255)
);

-- Create waste_personnel table
CREATE TABLE IF NOT EXISTS waste_personnel (
    id VARCHAR(5) NOT NULL PRIMARY KEY,
    profile_pic MEDIUMBLOB,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    address VARCHAR(255),
    work_id VARCHAR(255) NOT NULL,
    company_name VARCHAR(255) NOT NULL
);

-- Create schedule table
CREATE TABLE IF NOT EXISTS schedule (
    id VARCHAR(5) NOT NULL PRIMARY KEY,
    date DATE NOT NULL,
    time TIME NOT NULL,
    address VARCHAR(255) NOT NULL,
    area VARCHAR(255) NOT NULL,
    company VARCHAR(255) NOT NULL,
    trucks INT
);

-- Create feedback table
CREATE TABLE IF NOT EXISTS feedback (
    id VARCHAR(5) NOT NULL PRIMARY KEY,
    address VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    feedback TEXT NOT NULL
);

-- Create missed_pickups table
CREATE TABLE IF NOT EXISTS missed_pickups (
    id VARCHAR(5) NOT NULL PRIMARY KEY,
    area VARCHAR(255),
    address VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    complaint TEXT
);

 



-- Drop existing triggers if they exist
DROP TRIGGER IF EXISTS residents_before_insert;
DROP TRIGGER IF EXISTS waste_personnel_before_insert;
DROP TRIGGER IF EXISTS schedule_before_insert;
DROP TRIGGER IF EXISTS feedback_before_insert;
DROP TRIGGER IF EXISTS missed_pickups_before_insert;

-- Create triggers for automatic ID generation
DELIMITER //

CREATE TRIGGER residents_before_insert
BEFORE INSERT ON residents
FOR EACH ROW
BEGIN
    DECLARE next_val INT;
    SET next_val = (SELECT COALESCE(MAX(SUBSTRING(id, 2)), 0) FROM residents) + 1;
    SET NEW.id = CONCAT('R', LPAD(next_val, 3, '0'));
END//

CREATE TRIGGER waste_personnel_before_insert
BEFORE INSERT ON waste_personnel
FOR EACH ROW
BEGIN
    DECLARE next_val INT;
    SET next_val = (SELECT COALESCE(MAX(SUBSTRING(id, 2)), 0) FROM waste_personnel) + 1;
    SET NEW.id = CONCAT('W', LPAD(next_val, 3, '0'));
END//

CREATE TRIGGER schedule_before_insert
BEFORE INSERT ON schedule
FOR EACH ROW
BEGIN
    DECLARE next_val INT;
    SET next_val = (SELECT COALESCE(MAX(SUBSTRING(id, 2)), 0) FROM schedule) + 1;
    SET NEW.id = CONCAT('S', LPAD(next_val, 3, '0'));
END//

CREATE TRIGGER feedback_before_insert
BEFORE INSERT ON feedback
FOR EACH ROW
BEGIN
    DECLARE next_val INT;
    SET next_val = (SELECT COALESCE(MAX(SUBSTRING(id, 2)), 0) FROM feedback) + 1;
    SET NEW.id = CONCAT('F', LPAD(next_val, 3, '0'));
END//

CREATE TRIGGER missed_pickups_before_insert
BEFORE INSERT ON missed_pickups
FOR EACH ROW
BEGIN
    DECLARE next_val INT;
    SET next_val = (SELECT COALESCE(MAX(SUBSTRING(id, 2)), 0) FROM missed_pickups) + 1;
    SET NEW.id = CONCAT('M', LPAD(next_val, 3, '0'));
END//

//

DELIMITER ;

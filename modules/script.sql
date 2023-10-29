CREATE SCHEMA IF NOT EXISTS profileApp DEFAULT CHARACTER SET utf8;

USE profileapp;

CREATE TABLE
    IF NOT EXISTS users (
        users_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(64) NOT NULL UNIQUE,
        first_name VARCHAR(64) NOT NULL,
        last_name VARCHAR(64) NOT NULL,
        drowssap VARCHAR(255) NOT NULL,
        description varchar(255),
        isAdmin BOOLEAN DEFAULT FALSE,
        reset_token VARCHAR(64) NULL DEFAULT NULL,
        reset_token_expires_at DATETIME NULL DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS hobbies (
        hobbies_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
        hobby_name VARCHAR(255) NOT NULL UNIQUE
    );

CREATE TABLE
    IF NOT EXISTS user_hobbies (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        users_id INT NOT NULL,
        hobbies_id INT NOT NULL,
        FOREIGN KEY (users_id) REFERENCES users(users_id),
        FOREIGN KEY (hobbies_id) REFERENCES hobbies(hobbies_id)
    );

CREATE TABLE
    IF NOT EXISTS jobexperiences (
        jobexperiences_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        company_name VARCHAR(255) NOT NULL,
        job_title VARCHAR(255) NOT NULL,
        start_date DATE,
        end_date DATE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS user_jobexperiences (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        users_id INT NOT NULL,
        jobexperiences_id INT NOT NULL,
        FOREIGN KEY (users_id) REFERENCES users(users_id),
        FOREIGN KEY (jobexperiences_id) REFERENCES jobexperiences(jobexperiences_id)
    );

CREATE TABLE
    IF NOT EXISTS educations (
        educations_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
        education_name VARCHAR(64) NOT NULL,
        degree INT,
        school VARCHAR(64) NOT NULL,
        edu_start TIMESTAMP,
        edu_end TIMESTAMP,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

CREATE TABLE
    IF NOT EXISTS user_education (users_id INT, educations_id INT);

-- misschien weglaten?

CREATE TABLE
    IF NOT EXISTS subjects (
        subjects_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
        educations_id INT NOT NULL,
        subject_name VARCHAR(64) NOT NULL,
        grade FLOAT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

INSERT INTO
    users (
        email,
        first_name,
        last_name,
        drowssap,
        isAdmin
    )
VALUES (
        'example1@example.net',
        'Admin',
        '',
        '$argon2i$v=19$m=65536,t=4,p=1$VXo5ekRnWjNjMVc5T1FqeQ$T1na0ngG4fOILtapKbiv5dT9lFhDux/vQ3QE+NeqOWw',
        1
    );

INSERT INTO
    users (
        email,
        first_name,
        last_name,
        drowssap
    )
VALUES (
        'example2@example.net',
        'User',
        '',
        '$argon2i$v=19$m=65536,t=4,p=1$NEF6R3FuSjRFUkYzSEo4RQ$TGOUC2057pOTjxstOWELcCzOMLanJWpYkZDJaSCEOfs'
    );

INSERT INTO hobbies (hobbies_id, hobby_name) VALUES (1, 'Gamen');

INSERT INTO
    educations (education_name, degree, school)
VALUES (
        'Software development',
        4,
        'Windesheim'
    );

-- for testing purposes

INSERT INTO
    jobexperiences (company_name, job_title)
VALUES ('Supermarkt', 'Vakken vullen');
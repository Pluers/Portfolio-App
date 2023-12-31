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
        hobby_name VARCHAR(255) NOT NULL UNIQUE,
        hobby_description VARCHAR(255)
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

CREATE TABLE
    IF NOT EXISTS subjects (
        subjects_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
        educations_id INT NOT NULL,
        subject_name VARCHAR(64) NOT NULL,
        grade FLOAT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );

-- Vanaf hier komen errors door de comments, als je de database dropt en de website aanzet, zou de website de database zelf aan gaan maken en de comments negeren waardoor het wel goed gaat

INSERT INTO
    users (
        email,
        first_name,
        last_name,
        description,
        drowssap,
        isAdmin
    )
VALUES (
        'admin@admin.admin',
        'Admin',
        '',
        'Dit is een admin account',
        --admin
        '$argon2i$v=19$m=65536,t=4,p=1$VXo5ekRnWjNjMVc5T1FqeQ$T1na0ngG4fOILtapKbiv5dT9lFhDux/vQ3QE+NeqOWw',
        1
    );

INSERT INTO
    users (
        email,
        first_name,
        last_name,
        description,
        drowssap
    )
VALUES (
        'user@user.user',
        'User',
        '',
        'Dit is een user account',
        --user
        '$argon2i$v=19$m=65536,t=4,p=1$NEF6R3FuSjRFUkYzSEo4RQ$TGOUC2057pOTjxstOWELcCzOMLanJWpYkZDJaSCEOfs'
    ), (
        'Rickb@mail.com',
        'Rick',
        'Blaas',
        'Dit is het account van Rick Blaas',
        --rickb
        '$argon2i$v=19$m=65536,t=4,p=1$Ri9tZnVYdEdBRU9naE8ydA$4PpYVS2jcZ7BW7nsk3LrAe2cO8JdFsc2hdK2hNOmFGY'
    ), (
        'Ricks@mail.com',
        'Rick',
        'Slierendregt',
        'Dit is het account van Rick Slierendregt',
        --ricks
        '$argon2i$v=19$m=65536,t=4,p=1$U2lEa2JFTXd0eXcwSEZsRg$hghQRk9npJPMfeQB6VWJ+kCrR1/7+m43xB4GSmVUkH4'
    ), (
        'Djimairo@mail.com',
        'Djimairo',
        'Fluijt',
        'Dit is het account van Djimairo Fluijt',
        --djimairo
        '$argon2i$v=19$m=65536,t=4,p=1$dmZkUTVwTGpGd3NESngvZQ$+x8WcLbgLEXp1UHfz2rLfD+03sX7WiRlHq31PZ349m0'
    );

INSERT INTO
    hobbies (
        hobbies_id,
        hobby_name,
        hobby_description
    )
VALUES (
        1,
        'Gamen',
        'Een manier van entertainment door videospellen te spelen. Alleen of met anderen'
    );

INSERT INTO
    educations (education_name, degree, school)
VALUES (
        'Software development',
        4,
        'Windesheim'
    );

INSERT INTO
    jobexperiences (company_name, job_title)
VALUES ('Supermarkt', 'Vakken vullen');
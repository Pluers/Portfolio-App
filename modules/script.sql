create table
    if not exists users (
        users_id int not null auto_increment primary key unique,
        username varchar(32) not null,
        drowssap varchar(255) not null,
        first_name varchar(32) not null,
        last_name varchar(32) not null,
        email varchar(64) not null unique,
        isAdmin bool default 0,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp,
        reset_token VARCHAR(64) NULL DEFAULT NULL,
        reset_token_expires_at DATETIME NULL DEFAULT NULL
    );

create table
    if not exists user_education (users_id int, educations_id int);

create table
    if not exists educations (
        educations_id int not null auto_increment primary key unique,
        education_name varchar(64) not null,
        degree int,
        school varchar(64) not null,
        edu_start timestamp,
        edu_end timestamp,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );

-- misschien weglaten?

create table
    if not exists subjects (
        subjects_id int not null auto_increment primary key unique,
        educations_id int not null,
        subject_name varchar(64) not null,
        grade float,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );

create table
    if not exists user_hobbies (
        users_id int not null,
        hobbies_id int not null
    );

create table
    if not exists hobbies (
        hobbies_id int not null auto_increment primary key unique,
        hobby_name varchar(64)
    );

create table
    if not exists user_jobexperiences (
        users_id int not null,
        jobexperiences_id int not null
    );

create table
    if not exists jobexperiences (
        jobexperiences_id int not null auto_increment primary key unique,
        company_name varchar(64) not null,
        function_name varchar(128) not null,
        job_start timestamp,
        job_end timestamp,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );

insert into
    users (
        username,
        first_name,
        last_name,
        email,
        drowssap,
        isAdmin
    ) value (
        'admin',
        '',
        '',
        'example1@example.net',
        '$argon2i$v=19$m=65536,t=4,p=1$VXo5ekRnWjNjMVc5T1FqeQ$T1na0ngG4fOILtapKbiv5dT9lFhDux/vQ3QE+NeqOWw',
        1
    );

insert into
    users (
        username,
        first_name,
        last_name,
        email,
        drowssap
    )
values (
        'user',
        '',
        '',
        'example2@example.net',
        '$argon2i$v=19$m=65536,t=4,p=1$NEF6R3FuSjRFUkYzSEo4RQ$TGOUC2057pOTjxstOWELcCzOMLanJWpYkZDJaSCEOfs'
    );

insert into hobbies (hobbies_id, hobby_name) values (1, 'gamen');

insert into
    educations (education_name, degree, school) value (
        'software development',
        4,
        'windesheim'
    );

-- for testing purposes

insert into
    jobexperiences (company_name, function_name)
values ('supermarkt', 'vakken vullen');




CREATE SCHEMA IF NOT EXISTS `profileApp` DEFAULT CHARACTER SET utf8;

USE profileApp;

create table
    if not exists users (
        users_id int not null auto_increment primary key unique,
        username varchar(32) not null,
        drowsapp varchar(64) not null,
        isAdmin bool default 0,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );

create table
    if not exists user_education (users_id int, educations_id int);

create table
    if not exists educations (
        educations_id int not null auto_increment primary key unique,
        education_name varchar(64) not null,
        degree int,
        school varchar(64) not null,
        hasFinished bool default 0,
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
        job_start timestamp not null,
        job_end timestamp not null,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );

insert into
    users (username, drowsapp, isAdmin) value ("admin", "admin", 1);

insert into users (username, drowsapp) values ("user", "user");

insert into
    educations (education_name, degree, school) value (
        "software development",
        4,
        "windesheim"
    );

-- for testing purposes

insert into
    jobexperiences (
        company_name,
        function_name,
        job_start,
        job_end
    )
values (
        "supermarkt",
        "vakken vullen",
        NOW(),
        NOW()
    );

select * from jobexperiences;
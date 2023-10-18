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
    if not exists profiles (
        profiles_id int not null auto_increment primary key unique,
        users_id int,
        firstname varchar(32) not null,
        lastname varchar(32) not null,
        email varchar(32) not null,
    );

create table
    if not exists user_education (users_id int, educations_id int);

create table
    if not exists educations (
        educations_id int not null auto_increment primary key unique,
        education_name varchar(64) not null,
        degree int not null,
        school varchar(64) not null,
        edu_start timestamp not null,
        edu_end timestamp not null,
        hasFinished bool default 0,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );

create table
    if not exists subjects (
        subjects_id int not null auto_increment primary key unique,
        educations_id int not null,
        subject_name varchar(64) not null,
        grade float not null,
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    );

create table
    if not exists hobbies (
        hobbies_id int not null auto_increment primary key unique,
        users_id int not null,
        hobby_name varchar(64),
        hobby_description varchar(128)
    );

create table
    if not exists jobexperiences (
        jobexperiences_id int not null auto_increment primary key unique,
        users_id int not null,
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

insert into hobbies (hobby_name) value ("hardlopen");

select * from hobbies;

select
    users.username,
    hobbies.hobby_name
from users
    join user_hobbies, hobbies
where
    users.users_id = user_hobbies.users_id
    and hobbies.hobbies_id = user_hobbies.hobbies_id;

select * from hobbies;

insert into user_hobbies (users_id, hobbies_id) values (1,1);
drop schema profileApp;

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
    if not exists educations (
        educations_id int not null auto_increment primary key unique,
        users_id int,
        education_name varchar(64) not null,
        degree int not null,
        school varchar(64) not null,
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
        users_id int,
        hobby_name varchar(64)
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

insert into hobbies (users_id, hobby_name) value (2, "fietsen");

select * from hobbies h join users u where h.users_id = u.users_id;

select
    u.username,
    h.hobby_name
from users u
    join hobbies h
where h.users_id = u.users_id;

insert into educations
select
    u.username,
    e.education_name
from users u
    join education e
where e.users_id = u.users_id;
CREATE SCHEMA IF NOT EXISTS `profileApp` DEFAULT CHARACTER SET utf8;
USE profileApp;

create table if not exists users (
    users_id int not null auto_increment primary key unique,
    username varchar(32) not null,
    drowsapp varchar(64) not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table if not exists roles (
    roles_id int not null auto_increment primary key,
    users_id int not null,
    constraint users_id_fk_roles foreign key(users_id) references users(users_id),
    isAdmin bool,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table if not exists user_education (
    users_id int,
    educations_id int
);

create table if not exists educations (
    educations_id int not null auto_increment primary key unique,
    education_name varchar(64) not null,
    degree int not null,
    school varchar(64) not null,
    hasFinished bool default 0,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table if not exists subjects (
    subjects_id int not null auto_increment primary key unique,
    educations_id int not null,
    subject_name varchar(64) not null,
    grade float not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

create table if not exists user_hobbies (
    users_id int not null,
    hobbies_id int not null
);

create table if not exists hobbies (
    hobbies_id int not null auto_increment primary key unique,
    hobby_name varchar(64)
);

create table if not exists user_jobexperiences (
    users_id int not null,
    jobexperiences_id int not null
);

create table if not exists jobexperiences (
    jobexperiences_id int not null auto_increment primary key unique,
    company_name varchar(64) not null,
    function_name varchar(128) not null,
    job_start timestamp not null,
    job_end timestamp not null,
    created_at timestamp default current_timestamp,
    updated_at timestamp default current_timestamp on update current_timestamp
);

insert into users (username, drowsapp) value ("user", "user");
insert into users (username, drowsapp) value ("admin", "admin");
INSERT INTO roles (users_id, isAdmin) SELECT 2, 1 FROM users WHERE users_id = 2;

select * from users;

select roles.users_id, users.users_id, users.username, roles.isAdmin from roles join users;
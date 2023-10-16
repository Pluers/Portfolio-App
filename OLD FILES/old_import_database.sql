create table if not exists education
(
    id         int auto_increment
        primary key,
    education  varchar(32)                         not null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    updated_at timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP
);

create table if not exists hobbies
(
    id         int auto_increment
        primary key,
    hobby      varchar(32)                         not null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    updated_at timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP
);

create table if not exists modules
(
    id          int auto_increment
        primary key,
    modules     varchar(32)                         not null,
    description varchar(256)                        null,
    created_at  timestamp default CURRENT_TIMESTAMP null,
    updated_at  timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP
);

create table if not exists modules_has_users
(
    id         int auto_increment
        primary key,
    userId     int                                 not null,
    moduleId   int                                 not null,
    grade      float                               null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    updated_at timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP
);

create table if not exists users
(
    id         int auto_increment
        primary key,
    username   varchar(32)                         not null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    updated_at timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP,
    constraint id
        unique (id)
);

create table if not exists users_has_hobbies
(
    id         int auto_increment
        primary key,
    userid     int                                 not null,
    hobbiesid  int                                 not null,
    created_at timestamp default CURRENT_TIMESTAMP null,
    updated_at timestamp default CURRENT_TIMESTAMP null on update CURRENT_TIMESTAMP
);


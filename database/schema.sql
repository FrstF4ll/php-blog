drop table if exists users;
drop table if exists roles;
drop table if exists posts;

create table if not exists roles
(
    id          integer primary key autoincrement,
    description text not null
);

create table if not exists users
(
    id       integer primary key autoincrement,
    role_id  integer,
    name     text not null,
    email    text not null,
    password text not null,
    foreign key (role_id) references users (id)
);

create table if not exists posts
(
    id         integer primary key autoincrement,
    title      text                               not null,
    content    text                               not null,
    image      text,
    created_at datetime default current_timestamp not null,
    user_id    integer                            not null,
    foreign key (user_id) references users (id)
);

insert into roles(id, description)
values (1, 'User'),
       (2, 'Administrator');

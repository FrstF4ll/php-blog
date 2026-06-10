drop table if exists categories;
drop table if exists posts;
drop table if exists users;
drop table if exists roles;

create table if not exists roles
(
    id          integer primary key autoincrement,
    description text not null
);

create table if not exists categories
(
    id    integer primary key autoincrement,
    name  text not null,
    color text not null default '#f3f4f6',
    text_color text not null default '#374151'
);

create table if not exists users
(
    id       integer primary key autoincrement,
    role_id  integer,
    name     text not null,
    email    text not null,
    password text not null,
    foreign key (role_id) references roles (id)
);

create table if not exists posts
(
    id         integer primary key autoincrement,
    title      text                               not null,
    content    text                               not null,
    image      text,
    created_at datetime default current_timestamp not null,
    user_id    integer                            not null,
    cat_id     integer,
    foreign key (user_id) references users (id),
    foreign key (cat_id) references categories (id)
);


insert into roles(id, description)
values (1, 'User'),
       (2, 'Administrator');

insert into categories(id, name, color)
values (1, 'Uncategorized', '#f3f4f6'),
       (2, 'Technology', '#e0e7ff'),
       (3, 'Design', '#fae8ff'),
       (4, 'Business', '#dbeafe'),
       (5, 'Lifestyle', '#ccfbf1'),
       (6, 'Science', '#d1fae5'),
       (7, 'Health', '#fef3c7'),
       (8, 'Education', '#ffe4e6');

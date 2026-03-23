create table if not exists users
(
    id       integer primary key autoincrement,
    name     text not null,
    email    text not null,
    password text not null
);

create table if not exists posts
(
    id         integer primary key autoincrement,
    title      text    not null,
    content    text    not null,
    image      text,
    created_at datetime default current_timestamp not null,
    user_id    integer not null,
    foreign key (user_id) references users (id)
);

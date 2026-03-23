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
    title      text not null,
    content    text not null,
    image      text not null,
    created_at text not null,
    user_id    integer not null,
    foreign key (user_id) references users(id)
);
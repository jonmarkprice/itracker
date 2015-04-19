use jmp3748;

drop table if exists item;
create table item (
  id int primary key,
  item_name varchar(255) not null,
  unit enum('Each','6-pack') not null default 'Each',
  description varchar(255),
  item_type varchar(255),
  quantity smallint,
  in_date date,
 /* scent varchar(255)*/
);

drop table if exists user;
create table user (
  username varchar(255) primary key,
  firstname varchar(255),
  lastname varchar(255),
  password_hash varchar(255) not null,
  email varchar(255)
);


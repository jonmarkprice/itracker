use jmp3748;

drop table if exists user;
create table user (
  username varchar(255) primary key,
  firstname varchar(255),
  lastname varchar(255),
  password_hash varchar(255) not null,
  email varchar(255)
);

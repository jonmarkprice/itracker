use jmp3748;

drop table if exists item;
create table item (
  id int,
  owner varchar(255),
  name varchar(255) not null,
  unit enum('Each','6-pack') not null,
  description varchar(255),
  quantity int not null default 1,
  primary key (id, owner),
  foreign key (owner) references user(username)
);

drop table if exists user;

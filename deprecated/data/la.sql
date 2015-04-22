create table item(
  pid int not null,
  name varchar(255) not null,
  scent varchar(255),
  unit enum('Each','6-pack') not null,
  primary key(pid)
);

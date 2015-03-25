create table items (
  name varchar(255),
  description varchar(255),
  item_type varchar(255),
  quant smallint,
  in date
  id int primary key,
);

create table users (
  username varchar(255) primary key,
  fname varchar(255),
  lname varchar(255),
  password_hash varchar(255) not null,
  email varchar(255),
);


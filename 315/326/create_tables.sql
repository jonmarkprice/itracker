create table users (
  username varchar(255) primary key,
  firstname varchar(255),
  lastname varchar(255),
  pwhash varchar(255) not null,
  email varchar(255)
);


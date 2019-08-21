create database sns_php;

grant all on sns_php.* to dbuser@localhost identified by 'abc';

use sns_php

create table users (
  id int not null auto_increment primary key,
  username varchar(255),
  email varchar(255) unique,
  password varchar(255),
  created datetime,
  modified datetime
);

desc users;


-- ALTER TABLE users CHANGE COLUMN loginid username varchar(255);


create table thread_list (
  id int not null auto_increment primary key,
  title varchar(255),
  createdby varchar(255),
  created datetime,
  modified datetime
);

create table [title] (
  id int not null auto_increment primary key,
  writer varchar(255),
  content varchar(255),
  created datetime
);


create table comments (
  id int not null auto_increment primary key,
  writer varchar(255),
  content varchar(255),
  created datetime,
  threadid int,
  commentid int
);
-- create table comments (
--   id int not null auto_increment primary key,
--   writer varchar(255),
--   content varchar(255),
--   created datetime
-- );
--
-- create table threadcomment (
--   threadid int,
--   commentid int
-- );






insert into tttt (writer, content, created) values ("writer", "content", now())

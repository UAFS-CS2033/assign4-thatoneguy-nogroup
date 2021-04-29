use cs2033;
drop table contacts;

create table contacts(
   contactID int AUTO_INCREMENT,
   username varchar(15),
   email varchar(120),
   passwd varchar(30),
   primary key(contactID)
)engine=innodb;

insert into contacts(username,email,passwd) values('jsmith','jim.smith@gmail.com','pass1');
insert into contacts(username,email,passwd) values('mjones','mjones@gmail.com','pass2');
insert into contacts(username,email,passwd) values('rwilson','rick.wilson@gmail.com','12345');
insert into contacts(username,email,passwd) values('kjohnson','kjohnson@gmail.com','password');
insert into contacts(username,email,passwd) values('bwilliams','bwilliams@gmail.com','buddy');


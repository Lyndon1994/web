
create database bookcrossing;
use bookcrossing;


create table user(
userid int(10) not null primary key auto_increment,
username varchar(30) not null,
password varchar(20) not null,
address varchar(30) not null,
phone varchar(20) not null,
role varchar(30) not null,
credits int(3) not null
);


create table book(
bookid int(10) not null primary key auto_increment,
userid int(10) not null,
bookname varchar(30) not null,
author varchar(30) not null,
introduction varchar(30) not null,
status varchar(30) not null,
class varchar(30) not null,
image varchar(30)
);



create table log(
id int(10) not null primary key auto_increment,
bookid int(10) not null,
userid int(10) not null,
begintime date,
endtime date,
returntime date,
foreign key(bookid) references book(bookid),
foreign key(userid) references user(userid)
);


create table comments(
id int(10)  not null primary key auto_increment,
userid int(10) not null,
bookid int(10) not null,
content varchar(500),
foreign key(bookid) references book(bookid),
foreign key(userid) references user(userid)
);




insert into user values(NULL,'summer','1111','西安',1234128,'user',5);
insert into user values(NULL,'haha','1111','西电',123456,'manager',5);


 insert into book(bookid,userid,bookname,author,introduction,status,class)value
 	(NULL,2,'幻城','郭敬明','前世','阅读中','玄幻');



insert into log values(NULL,1,2,'2016-05-04','2016-06-04','2016-06-01');


 insert into comments values(NULL,2,1,'这本书很好看，很有想象力');

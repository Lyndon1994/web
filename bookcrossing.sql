CREATE DATABASE bookcrossing
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;
USE bookcrossing;


CREATE TABLE user (
  userid   INT(10)     NOT NULL PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  password VARCHAR(20) NOT NULL,
  address  VARCHAR(30) NOT NULL,
  phone    VARCHAR(20) NOT NULL,
  role     VARCHAR(30) NOT NULL,
  credits  INT(3)      NOT NULL
);


CREATE TABLE book (
  bookid       INT(10)     NOT NULL PRIMARY KEY AUTO_INCREMENT,
  userid       INT(10)     NOT NULL,
  bookname     VARCHAR(30) NOT NULL,
  author       VARCHAR(30) NOT NULL,
  introduction VARCHAR(30) NOT NULL,
  status       VARCHAR(30) NOT NULL,
  class        VARCHAR(30) NOT NULL,
  image        VARCHAR(30)
);


CREATE TABLE log (
  id         INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  bookid     INT(10) NOT NULL,
  userid     INT(10) NOT NULL,
  begintime  DATE,
  endtime    DATE,
  returntime DATE,
  FOREIGN KEY (bookid) REFERENCES book (bookid),
  FOREIGN KEY (userid) REFERENCES user (userid)
);


CREATE TABLE comments (
  id      INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  userid  INT(10) NOT NULL,
  bookid  INT(10) NOT NULL,
  content VARCHAR(500),
  FOREIGN KEY (bookid) REFERENCES book (bookid),
  FOREIGN KEY (userid) REFERENCES user (userid)
);


INSERT INTO user VALUES (NULL, 'summer', '1111', '西安', 1234128, 'user', 5);
INSERT INTO user VALUES (NULL, 'haha', '1111', '西电', 123456, 'manager', 5);


INSERT INTO book (bookid, userid, bookname, author, introduction, status, class) VALUE
  (NULL, 2, '幻城', '郭敬明', '前世', '阅读中', '玄幻');


INSERT INTO log VALUES (NULL, 1, 2, '2016-05-04', '2016-06-04', '2016-06-01');


INSERT INTO comments VALUES (NULL, 2, 1, '这本书很好看，很有想象力');

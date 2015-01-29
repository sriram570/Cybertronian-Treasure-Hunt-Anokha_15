CREATE TABLE questions(
level_no int,
answer varchar(255),
score int,
primary key(level_no)
);


CREATE TABLE users(
	username varchar(255),    
	mailid varchar(255),
	pword varchar(255), 
	score int,
	level_no int,
	foreign key (level_no) references questions(level_no)
);

insert into questions(1,'answer1',10);
insert into questions(2,'answer2',10);
insert into questions(3,'answer3',10);
insert into questions(4,'answer4',10);
insert into questions(5,'answer5',10);



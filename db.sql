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


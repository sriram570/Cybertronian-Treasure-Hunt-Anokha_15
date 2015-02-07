use treasurehunt;
CREATE TABLE questions(
level_no int,
answer varchar(255),
score int,
primary key(level_no)
);


CREATE TABLE users(
	username varchar(255),    
	anokhaid varchar(255),
	score int,
	level_no int,
	date_time datetime,
	foreign key (level_no) references questions(level_no)
);

insert into questions values(1,'answer1',10);
insert into questions values(2,'answer2',10);
insert into questions values(3,'answer3',10);
insert into questions values(4,'answer4',10);
insert into questions values(5,'answer5',10);
insert into questions values(6,'answer6',10);


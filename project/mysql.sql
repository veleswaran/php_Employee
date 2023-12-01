create table Employee (
id int primary key auto_increment,
name text,
gender enum('male','female'),
DOB date,
Address text,
mobile bigint,
email text,
depart_id int,
designation_id int,
DOJ date,
image text,
foreign key(depart_id) references Department (id),
foreign key(designation_id)references Designation(id));


create table Department (
id int primary key auto_increment,
dept_name text,
description text);
select *from Department;
delete from Department where id=4;


create table Designation(
id int primary key auto_increment,
designation_name text,
dept_id int,
description text,
foreign key(dept_id)references Department(id));
select * from Designation;

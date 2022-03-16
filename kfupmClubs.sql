SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE `StatusType` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(20) NOT NULL,
Descr varchar(50) NOT NULL,
primary key(ID)
);

CREATE TABLE `Status` (
ID int NOT NULL AUTO_INCREMENT,
StatusTypeID int NOT NULL,
Name varchar(20) NOT NULL,
Descr varchar(50) NOT NULL,
primary key(ID),
foreign key (StatusTypeID) references StatusType(ID)
);

CREATE TABLE `Rule` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(20) NOT NULL,
ClubID int NOT NULL,
Descr varchar(50) NOT NULL,
StatusID int NOT NULL,
primary key(ID),
foreign key (StatusID) references Status(ID),
foreign key (ClubID) references Club(ID)
);

CREATE TABLE `ProjectType` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(20) NOT NULL,
Descr varchar(50) NOT NULL,
primary key(ID)
);

CREATE TABLE `Project` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(20) NOT NULL,
ProjectTypeID int NOT NULL,
ClubID int NOT NULL,
Descr varchar(50) NOT NULL,
StartDate date NOT NULL,
EndDate date NOT NULL,
StatusID int NOT NULL,
primary key(ID),
foreign key (StatusID) references Status(ID),
foreign key (ClubID) references Club(ID),
foreign key (ProjectTypeID) references ProjectType(ID)
);

CREATE TABLE `Department` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(20) NOT NULL,
Phone varchar(20) NOT NULL,
Email Varchar(30) NOT NULL,
primary key(ID)
);

CREATE TABLE `Student` (
ID int NOT NULL,
Fname varchar(15) NOT NULL,
Lname varchar(15) NOT NULL,
Phone varchar(20) NOT NULL,
StatusID int NOT NULL,
primary key(ID),
foreign key (StatusID) references Status(ID)
);

CREATE TABLE `Club` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(15) NOT NULL,
Address varchar(30) NOT NULL,
Phone varchar(20) NOT NULL,
Descr varchar(50) NOT NULL,
DepartmentID int NOT NULL,
StatusID int NOT NULL,
primary key(ID),
foreign key (StatusID) references Status(ID),
foreign key (DepartmentID) references Department(ID)
);

CREATE TABLE `ClubMember` (
ClubID int NOT NULL,
StudentID int NOT NULL,
FromDate date NOT NULL,
ToDate date NOT NULL,
StatusID int NOT NULL,
primary key(ClubID,StudentID,FromDate),
foreign key (StatusID) references Status(ID),
foreign key (ClubID) references Club(ID),
foreign key (StudentID) references Student(ID)
);

CREATE TABLE `ClubAdmin` (
ClubID int NOT NULL,
StudentID int NOT NULL,
FromDate date NOT NULL,
ToDate date NOT NULL,
Role varchar(15) NOT NULL,
primary key(ClubID,StudentID,FromDate),
foreign key (ClubID) references Club(ID),
foreign key (StudentID) references Student(ID)
);

CREATE TABLE `WorksOn` (
StudentID int NOT NULL,
ProjectID int NOT NULL,
FromDate date NOT NULL,
ToDate date NOT NULL,
Role varchar(15) NOT NULL,
primary key(StudentID,ProjectID,FromDate),
foreign key (StudentID) references Student(ID),
foreign key (ProjectID) references Project(ID)
);

CREATE TABLE `ResourceType` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(20) NOT NULL,
Descr varchar(50) NOT NULL,
primary key(ID)
);

CREATE TABLE `Resource` (
ID int NOT NULL AUTO_INCREMENT,
Name varchar(20) NOT NULL,
ResourceTypeID int NOT NULL,
Descr varchar(50) NOT NULL,
StatusID int NOT NULL,
primary key(ID),
foreign key (StatusID) references Status(ID),
foreign key (ResourceTypeID) references ResourceType(ID)
);

CREATE TABLE `ProjResource` (
ProjectID int NOT NULL,
ResourceID int NOT NULL,
FromDate date NOT NULL,
ToDate date NOT NULL,
primary key(ProjectID,ResourceID),
foreign key (ProjectID) references Project(ID),
foreign key (ResourceID) references Resource(ID)
);
CREATE TABLE `UserType`(
ID int not null,
Name varchar(20) not null,
Descr Varchar(50) not null,
Primary key (ID)
);

CREATE TABLE `User` (
ID int not null,
UserName VARCHAR(25) NOT NULL,
Password Varchar(50) not null,
UserTypeID int not null,
StatusID int not null, 
Primary key (ID,UserName),
foreign key (UserTypeID) references UserType(ID),
foreign key (StatusID) references Status(ID)
);

INSERT INTO StatusType(Name,Descr) VALUES 
('project','status for the projects'),
('club','status for the clubs'),
('student','status for the students'),
('resource','status for the resources'),
('rule','status for the role of the member');

INSERT INTO Status(StatusTypeID,Name,Descr) VALUES 
('1','ongoing','the project is still going'),
('1','canclled','the project is canclled'),
('1','completed','the project is completed'),
('2','active','the club is active'),
('2','not active','the club is not active'),
('3','satisfy','the student satisfy rules'),
('3','does not satisfy','the student does not satisfy rules'),
('3','Active','the students account is active'),
('3','pending','the students account is pending'),
('3','Deactivated','the students account is pending'),
('4','available','the resoucess are available'),
('4','not available','the resoucess are not available');

INSERT INTO Rule(Name,ClubID,Descr,StatusID) VALUES 
('major','1','must be a computer major student','6'),
('majorc','2','must be a chemistry major student','6'),
('major','3','must be a physics major student','6'),
('major','4','must be a software major student','7');

INSERT INTO ProjectType(Name,Descr) VALUES 
('sports','concerned by soprt activites'),
('social','concerned by social activites'),
('religious','concerned by religious activites'),
('academic','concerned by academic activites');


INSERT INTO Project(Name,ProjectTypeID,ClubID,Descr,StartDate,EndDate,StatusID) VALUES 
('global event','2','3','to discuss global programming','2020/12/12','2020/12/14','3'),
('chemistry event','4','2','to discuss chemistry','2020/12/12','2020/12/14','2'),
('computer event','1','1','compter contest','2020/11/12','2020/11/14','1');

INSERT INTO Department(Name,Phone,Email) VALUES  
('Computer Science','05432344321','computer@hotmail.com'),
('Chemistry','05145344321','chemistry@hotmail.com'),
('Phyiscs','05432398921','phyiscs@hotmail.com'),
('Software Engneering','05432556621','software@hotmail.com');


INSERT INTO Student(ID,Fname,Lname,Phone,StatusID) VALUES 
('1','abdullah','hussain','0564568788','6'),
('2','ahmad','mohammad','0564666788','7'),
('3','abdullah','bader','0577768788','7'),
('4','nawaf','mohammad','0588868788','6'),
('5','yasser','yousuf','0522338788','6');

INSERT INTO Club(Name,Address,Phone,Descr,DepartmentID,StatusID) VALUES 
('love','ryiadh','0564568788','club to spread love','1','5'),
('strength','khobar','0512123458','club to show the strength of scince','3','4'),
('lion','jeddah','0544667678','club to introduce software engineering','4','4'),
('calm','dahran','0566778889','club to introduce chimestry','2','4');


INSERT INTO ClubMember(ClubID,StudentID,FromDate,ToDate,StatusID) VALUES 
('1','1','2020/11/11','2020/12/12','6'),
('2','3','2020/11/11','2020/12/12','6'),
('3','4','2020/11/11','2020/12/12','7'),
('4','5','2020/11/11','2020/12/12','6');


INSERT INTO ClubAdmin(ClubID,StudentID,FromDate,ToDate,Role) VALUES 
('1','5','2019/1/1','2020/1/1','president'),
('1','1','2019/1/1','2020/1/1','member'),
('2','4','2019/1/1','2020/1/1','president'),
('2','5','2019/1/1','2020/1/1','secrtary'),
('3','2','2019/1/1','2020/1/1','member');

INSERT INTO WorksOn(StudentID,ProjectID,FromDate,ToDate,Role) VALUES 
('1','1','2020/12/12','2020/12/14','leader'),
('2','1','2020/12/12','2020/12/14','member'),
('2','2','2020/12/12','2020/12/14','leader'),
('3','2','2020/12/12','2020/12/14','member'),
('4','2','2020/12/12','2020/12/14','member');

INSERT INTO ResourceType(Name,Descr) VALUES 
('venue','venue required'),
('vehicle','vehicle required'),
('food','food required');


INSERT INTO Resource(Name,ResourceTypeID,Descr,StatusID) VALUES 
('theater','1','theater for lectuers','8'),
('playground','1','playground for sports','8'),
('mini car','2','small car for people','8'),
('sportcar','2','sport car for people','9'),
('pizza','3','pizza for audiance','8');

INSERT INTO ProjResource(ProjectID,ResourceID,FromDate,ToDate) VALUES 
('1','1','2020/11/11','2020/11/12'),
('1','5','2020/11/11','2020/11/12'),
('2','1','2020/10/19','2020/10/20'),
('2','3','2020/10/19','2020/10/20'),
('2','4','2020/10/19','2020/10/20');

INSERT INTO UserType(ID,Name,Descr) VALUES
('1','SystemAdmin','the admin of the system'),
('2','ClubAdmin','a club admin'),
('3','ClubMember','a club member'),
('4','Guest','a guest');

INSERT INTO User(ID,UserName,Password,UserTypeID,StatusID) VALUES
('201772950','HassanAlbanayi','KFUPM123','1','8');

SET FOREIGN_KEY_CHECKS=1;


Select * from club;

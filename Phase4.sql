drop database tabuco;

create database tabuco;
use tabuco

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

create table schedule (booking_date date, 
	agency_id varchar(10) not null,
	location varchar(50) not null,
	cas_id varchar(10) not null,
	dat_id varchar(10) not null, 
	bio_id varchar(10) not null,
	primary key (booking_date, agency_id));

create table receipt (id int,
	username varchar(50),
	or_no char(10), 
	family_name varchar(30) not null,
	first_name varchar(30) not null,
	middle_name varchar(30), 
	husband_surname varchar(30), 
	address varchar(255),
	date_of_birth date, 
	place_of_birth varchar(50), 
	civil_status varchar(20) check (civil_status in ('Single','Married', 'Divorced', 'Widowed')),
	purpose varchar(100), 
	gender varchar(6) check (gender in ('Male','Female')),
	dst_paid varchar(8) check (dst_paid in ('Paid','Not Paid')),
	primary key (or_no),
	foreign key (id) references users(id) on update cascade,
	foreign key (username) references users(username) on update cascade);

create table certificate (cert_no char(8), 
	agency_id varchar(10), 
	resched_date date,
	pri_id varchar(10), 
	print_date date, 
	exp_date date, 
	director varchar(50),
	primary key (cert_no, agency_id, resched_date));

create table nbi (nbi_id int auto_increment, 
	booking_date date,
	cert_no char(8), 
	reference_code char(10),
	id int not null,
	or_no char(10),
	resched_date date, 
	agency_id varchar(10),
	primary key (nbi_id),
	foreign key (booking_date) references schedule(booking_date)
		on delete set null,
	foreign key (cert_no, agency_id, resched_date) references certificate (cert_no, agency_id, resched_date)
		on delete set null,
	foreign key (id) references users(id) on update cascade);

insert into users values(1,'phrungck','$2y$10$I6i6Ip4/bM1UCHlOHYYsy.L4pTwMTWlvCsrdbrCDxeYMesHJc5lLu','2019-11-25 11:27:19'),
	(2,'juan','$2y$10$xpOSb6DQPfMB72r3BdqevuX8jiM/5AfSjlZkfn8r.b9ksP2PBFBqW','2019-11-25 11:27:32'),
	(3,'aimeee','$2y$10$w/ifI38LH7JqPCY/Ov/bseAoVRtylp2xwvHTP4ZIYd3S8GRYTqPZi','2019-11-25 11:27:39');

insert into schedule values('2019-12-02', 'ls','Calamba', 'marcoj','marcoj','jade1'),
	('2019-12-03','ls','Calamba','marcoj','jules2','jules2'),
	('2019-12-04','ls','Calamba','marcoj','marcoj','marcoj'),
	('2019-12-05','ls','Calamba','erisx','erisx','erisx'),
	('2019-12-06','ls','Calamba','jade1','marcoj','erisx'),
	('2019-12-02','KatA','Katipunan','josef20','felx','felx'),
	('2019-12-03','KatA','Katipunan','josef20','josef20','josef20'),
	('2019-12-04','KatA','Katipunan','felx','ir0','ir0'),
	('2019-12-05','KatA','Katipunan','felx','josef20','ir0'),
	('2019-12-06','KatA','Katipunan','jhi','ir0','felx'),
	('2018-09-09','ls','Calamba','jade1','marcoj','marcoj');

insert into certificate values('10285810','ls','2019-12-06','kat23','2019-12-06',
	'2020-12-06', 'Atty. Dante A. Cruz'),
	('10285181', 'ls', '2019-12-02','marc0','2019-12-02','2020-12-02','Atty. Dante A. Cruz'),
	('10295481', 'ls','2019-12-02','marc0','2019-12-02','2020-12-02','Atty. Dante A. Cruz'),
	('10298500', 'ls', '2019-12-03', 'juile','2019-12-03','2020-12-03','Atty. Dante A. Cruz'),
	('10291712','ls','2019-12-05','marc0','2019-12-05','2020-12-05','Atty. Dante A. Cruz'),
	('10291111','ls','2019-12-06','kat23','2019-12-06','2020-12-06','Atty. Dante A. Cruz'),
	('10102848','ls','2018-09-09','marc0','2018-09-09','2019-09-09','Atty. Dante A. Cruz');

insert into receipt values (1,'phrungck','MSAKDIO20K','Tabuco','Frank Cally','Almaden',
	null, '789 Rosal St., Calamba City, Laguna','1995-05-22','Mandaue City, Cebu',
	'Single','Multi-purpose','Male','Paid'),
	(2,'juan','IQOM29MG0P','Dela Cruz','Juan','Carlo',null,'928 Felix Reyes St., Sta. Rosa',
	'1979-02-18','Borongan, Samar','Married','Renewal','Male','Paid'),
	(3,'aimeee','BMSJ10LAPG','Montes','Julia','Bontoc','Zamora','Brgy. Dila, Bay, Laguna',
	'1990-04-12','Brgy. Halang, Calamba City, Laguna','Married','Multi-purpose',
	'Female','Paid'),
	(1,'phrungck','IQO081MZJA','Tabuco','Frank Cally','Almaden',
	null, '789 Rosal St., Calamba City, Laguna','1995-05-22','Mandaue City, Cebu',
	'Single','Multi-purpose','Male','Paid');

insert into nbi (booking_date, cert_no, reference_code, id, or_no, resched_date,
	agency_id) values ('2019-12-02','10285181','XAKQI0L1PL',1,'MSAKDIO20K','2019-12-2','ls'),
	('2019-12-03','10285810','MALFPI10AK',2,'IQOM29MG0P','2019-12-06','ls'),
	('2019-12-03','10291712','MALSDJPI10',3,'BMSJ10LAPG','2019-12-05','ls'),
	('2018-09-09','10102848','LAKFOQM1M3',1,'IQO081MZJA','2018-09-09','ls');


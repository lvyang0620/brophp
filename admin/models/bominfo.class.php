<?php
	class Bominfo {
		function createBomTable($tablename){
			$db=D();
			$sql="create table {$tablename}(partcode char(20) not null primary key,num int,refs varchar(500),substitute char(20),accounting bool default '1') engine=InnoDB character set utf8 collate utf8_general_ci;";
			$result=$db->query($sql);
			return $result;
		}

		//删除表函数
		function delBomTable($tablename){
			$db=D();
			$sql="drop table {$tablename};";
			$result=$db->query($sql);
			return $result;
		}

		function createEcnRecTable($tablename){
			$db=D();
			$sql="create table {$tablename}(item int not null primary key auto_increment,ecn_num varchar(50) not null unique,description varchar(250),ecntime int not null) engine=InnoDB character set utf8 collate utf8_general_ci;";
			p($sql);
			$result=$db->query($sql);
			return $result;
		}

		function createEcnDetailTable($tablename){
			$db=D();
			$sql="create table {$tablename}(item int not null primary key,reason varchar(50),description varchar(250),act varchar(50),partcode char(20),new_num int,new_refs varchar(500),new_substitute char(20),action_type char(50),oldpart_dealing char(50)) engine=InnoDB character set utf8 collate utf8_general_ci;";
			p($sql);
			$result=$db->query($sql);
			return $result;
		}
	}

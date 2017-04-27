<?php
	class Bominfo {
		function createBomTable($tablename){
			$db=D();
			$sql="create table {$tablename}(partcode char(20) not null primary key,num int,refs varchar(500),substitute char(20),accounting bool default '1') engine=InnoDB character set utf8 collate utf8_general_ci;";
			$result=$db->query($sql);
			return $result;
		}

		function delBomTable($tablename){
			$db=D();
			$sql="drop table {$tablename};";
			$result=$db->query($sql);
			return $result;
		}



	}

<?php
	class Hello extends Action{
		function test(){
			p("Hello test .......");
			if($_GET["d"]==1)
				//$this->success("添加用户成功",5,"flink/add/cid/5/page/88");
				$this->redirect("flink/add/cid/5/page/100");
			else
				$this->error("添加用户失败",3,"demo");

		}
		function demo(){
			p("Hello demo .......");
		}
	
	}

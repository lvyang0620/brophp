<?php
	class Index {
		function index(){
			$user=D("user");
			$data=$user->select();
			$this->assign("data",$data);
			//$this->display("user/index");
			$this->display();
		}		
		function add(){
			$this->display();
		}
		function mod(){
			$this->display();
		}

	}

<?php
	class User{
		function index(){
			$user=D("user");
			$page=new Page($user->total(),5);
			$page->set("next",">>")
			     ->set("last",">|")
			     ->set("prev","<<")
			     ->set("first","|<");

			$data=$user->order("id desc")->limit($page->limit)->select();
			//p($data);
			
			$this->assign("data",$data);
			//$this->assign("fpage",$page->fpage(0,1,2,3,4,5,6,7));
			$this->assign("fpage",$page->fpage(1,2,3,4,5,6,0));

			$this->display();
		}
		
		function add(){
			$this->display();
		}
		function addpic(){

			
			$this->display();
		}
		function insert(){
			//p($_POST);
			$user=D("user");

			if($user->insert()){
				$this->success("添加用户成功！",3,"index");
			}else{
				$this->error($user->getMsg(),5,"add");
			}	

		}

		function del(){
			//p("User/del......");
			$user=D("user");
			//$_POST["id"]=array(2,3);
			//if($user->delete($_POST["id"])){
			if($user->where("id>4")->delete()){
				$this->redirect("index");
			}else{
				$this->error("修改用户失败！",5,"index");
			}
		}
		
	}

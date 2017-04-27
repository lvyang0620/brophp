<?php
	class User{
		function index(){
			//p("User/index......");
			$user=D("user");
			//$data=$user->where('1,4,8')
			//$data=$user->where(array(1,4,8))
			//$data=$user->where(array("sex"=>"女"))
			//$data=$user->where(array("name"=>"%a%"))
			//$data=$user->where(array("age >"=>"30"))
			//$data=$user->where(array("age >"=>"20","age <="=>"30"))
			//$data=$user->where(array("age >"=>"20","age <="=>"30"),array("sex"=>"male"))
				//->select();
			//$data=$user->field("id,name,sex")->find(11);
			$data=$user->where(array("sex"=>"male"))->total();
			p($data);
		}
		
		function add(){
			//p("User/add......");
			$user=D("user");
			$_POST=array(
				"name"=>"王五",
				"age"=>33,
				"sex"=>"男",
				"email"=>"wangwu@brophp.com",
				"sub"=>"注册"
			);
			$result=$user->insert($_POST);
			if($result){
				p($result);
				$this->success("添加数据成功！",3,"index");
			}else{
				$this->error("添加数据失败！",5,"index");
			}
		}
		function mod(){
			//p("User/mod......");
			$user=D("user");
			$_POST=array(
				//"id"=>7,
				//"name"=>"赵六",
				//"age"=>44,
				//"sex"=>"男",
				//"email"=>"zhaoliu@brophp.com",
				"ptime"=>time(),
				"sub"=>"修改"
			);
			//$rows=$user->where("4")->update($_POST);
			$rows=$user->where("4")->update("age=age+1");
			if($rows>0){
				$this->success("修改数据成功！",3,"index");
			}else{
				$this->error("修改用户失败！",5,"index");
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

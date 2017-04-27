<?php
	class User extends Action{
		function index(){
			$this->display();
		}
		
		function login(){
			$this->display();
		}
		function islogin(){
			if($_POST["username"]=="" || $_POST["password"]==""){
				$this->error("用户名和密码不能为空！",3,"login");
			}
			$user=D("user");
			//$data=$user->field("id,username")->where(array("username"=>$_POST["username"],"password"=>md5($_POST["password"])))->find();
			//$data=$user->where(array("username"=>$_POST["username"]))->find();
			$data=$user->field("id,username")->where(array("username"=>$_POST["username"]))->find();
						
			if($data!=NULL){
				$_SESSION=$data;
				//$_COOKIE=$data;

				$_SESSION["isLogin"]=true;
				//$_COOKIE["isLogin"]=true;

				//p($_SESSION);
				//p($_COOKIE);
				$this->success("用户登录成功！",3,"index/index");
			}else{
				$this->error("用户登录失败！",3,"login");
			}
			
		}
		function islogout(){
			//p($_SESSION["username"]);
			$username=$_SESSION["username"];
			$_SESSION=array();
			if(isset($_COOKIE[session_name()])){
				setCookie(session_name(),'',time()-3600,"/");
			}
			session_destroy();
			$this->success("再见{$username}",3,"login");
		}
		function reg(){
			$this->display();
		}
		function insert(){
			$user=D("user");
			$_POST["password"]=md5($_POST["password"]);	
			$_POST["repassword"]=md5($_POST["repassword"]);
			if($user->insert()){
				$this->success("注册成功",3,"index");
			}else{
				$this->error($user->getMsg(),5,"reg");
			}
		}



	}

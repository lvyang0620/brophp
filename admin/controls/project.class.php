<?php
	class Project {
		function index(){
			$pro=D("project");
                	$total=$pro->total();
			$page=new Page($total,15);

			$this->assign("proj",$pro->field("id,name,description,pid")->limit($page->limit)->select());
			$this->assign("fpage",$page->fpage());

			$this->display();	
		}
		function add(){
			$this->display();	
		}
		function insert(){
			$pro=D("project");
			//p($_POST);
			if($pro->insert()){
				$this->success("添加项目成功！",1,"index");
			}else{
				$this->error($pro->getMsg(),3,"add");
			}	
		}
		function mod(){
			$pro=D("project");
			$data=$pro->find($_GET["id"]);
			$this->assign("data",$data);
			$this->display();	
		}
		function update(){
		        $pro=D("project");  
			$predate=$pro->find($_POST["id"]);			
                        //p($predate);
			//p($_POST);        
			if($predate==$_POST){
                             	$this->error("项目信息相同，没有修改",3,"index");
			}else{
                        	if($pro->update()){
                                	$this->success("项目信息修改成功！",1,"index");
                        	}else{
                                	$this->error($pro->getMsg(),3,"project/mod/id/{$_POST["id"]}");
                        	}  
			}
		}
		function del(){
		        $pro=D("project");  
                        if($pro->delete($_GET["id"])){
                                $this->redirect("index");
                        }else{
                                $this->error($pro->getMsg(),3,"index");
                        }  
		
		}
	
	}

<?php
	class Cat {
		function index(){
			$cat=D("cat");
			$this->assign("cats",$cat->field("id,name")->select());
			$this->display();	
		}
		function add(){
			$this->display();	
		}
		function insert(){
			$cat=D("cat");
			if($cat->insert()){
				$this->success("添加类别成功！",1,"index");
			}else{
				$this->error($cat->getMsg(),3,"add");
			}	
		}
		function mod(){
			$cat=D("cat");
			$data=$cat->find($_GET["id"]);
			$this->assign("data",$data);
			$this->display();	
		}
		function update(){
		        $cat=D("cat");  
                        if($cat->update()){
                                $this->success("修改类别成功！",1,"index");
                        }else{
                                $this->error($cat->getMsg(),3,"cat/mod/id/{$_POST["id"]}");
                        }  
		}
		function del(){
		        $cat=D("cat");  
                        if($cat->delete($_GET["id"])){
                                $this->redirect("index");
                        }else{
                                $this->error($cat->getMsg(),3,"index");
                        }  
		
		}
	
	}

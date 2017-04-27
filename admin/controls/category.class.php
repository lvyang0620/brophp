<?php
	class Category {
		function index(){
			$cat=D("category");
                	$total=$cat->total();
			$page=new Page($total,15);

			$this->assign("cats",$cat->field("id,name,description,pid,lossrate,lossclass")->limit($page->limit)->select());
			$this->assign("fpage",$page->fpage());

			$this->display();	
		}
		function add(){
			$this->display();	
		}
		function insert(){
			$cat=D("category");
			//p($_POST);
			if($cat->insert()){
				$this->success("添加类别成功！",1,"index");
			}else{
				$this->error($cat->getMsg(),3,"add");
			}	
		}
		function mod(){
			$cat=D("category");
			$data=$cat->find($_GET["id"]);
			$this->assign("data",$data);
			$this->display();	
		}
		function update(){
		        $cat=D("category");  
			$predate=$cat->find($_POST["id"]);			
                        //p($predate);
			//p($_POST);        
			if($predate==$_POST){
                             	$this->error("数据相同，没有修改",3,"index");
			}else{
                        	if($cat->update()){
                                	$this->success("修改类别成功！",1,"index");
                        	}else{
                                	$this->error($cat->getMsg(),3,"category/mod/id/{$_POST["id"]}");
                        	}  
			}
		}
		function del(){
		        $cat=D("category");  
                        if($cat->delete($_GET["id"])){
                                $this->redirect("index");
                        }else{
                                $this->error($cat->getMsg(),3,"index");
                        }  
		
		}
	
	}

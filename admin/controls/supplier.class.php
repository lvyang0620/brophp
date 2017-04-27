<?php
	class Supplier {
		function index(){
			$sup=D("supplier");
                        $total=$sup->total();
                        //p($total);            
                        $page=new Page($total,15);                      //创建分页

			$this->assign("sup",$sup->field("id,name,contacts,phonenum,address,agent")->limit($page->limit)->select());
                        $this->assign("fpage",$page->fpage());

			$this->display();	
		}
		function add(){
			$this->display();	
		}
		function insert(){
			$sup=D("supplier");
			//p($_POST);
			if($sup->insert()){
				$this->success("添加供应商成功！",1,"index");
			}else{
				$this->error($sup->getMsg(),3,"add");
			}	
		}
		function mod(){
			$sup=D("supplier");
			$data=$sup->find($_GET["id"]);
			//p($data);
			$this->assign("data",$data);
			$this->display();	
		}
		function update(){
		        $sup=D("supplier");
			$predata=$sup->find($_POST["id"]);
			p($predata);
			p($_POST);
			if($_POST["contacts"]==NULL){
				$_POST["contacts"]="无";
			}
			if($_POST["phonenum"]==NULL){
				$_POST["phonenum"]="无";
			}
			if($_POST["address"]==NULL){
				$_POST["address"]="无";
			}
			if($_POST["agent"]==NULL){
				$_POST["agent"]="无";
			}
			if($predata==$_POST){
                               	$this->error("数据相同，没有修改！",3,"index");
			}else{
				$result=$sup->update();
				p($result);
                        	if($result){
                                	$this->success("修改供应商成功！",3,"index");
                        	}else{
                                	$this->error($sup->getMsg(),3,"supplier/mod/id/{$_POST["id"]}");
				}
			}  
		}
		function del(){
		        $cat=D("supplier");  
                        if($cat->delete($_GET["id"])){
                                $this->redirect("index");
                        }else{
                                $this->error($cat->getMsg(),3,"index");
                        }  
		
		}
	
	}

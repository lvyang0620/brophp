<?php
	class Custom {
		function index(){
			$cus=D("custom");
                        $total=$cus->total();
                        //p($total);            
                        $page=new Page($total,15);                      //创建分页

			$this->assign("cus",$cus->field("id,name,shortname,contacts,phonenum,address")->limit($page->limit)->select());
                        $this->assign("fpage",$page->fpage());

			$this->display();	
		}
		function add(){
			$this->display();	
		}
		function insert(){
			$cus=D("custom");
			p($_POST);
			if($cus->insert()){
				$this->success("添加客户信息成功！",1,"index");
			}else{
				$this->error($cus->getMsg(),3,"add");
			}	
		}
		function mod(){
			$cus=D("custom");
			$data=$cus->find($_GET["id"]);
			//p($data);
			$this->assign("data",$data);
			$this->display();	
		}
		function update(){
		        $cus=D("custom");
			$predata=$cus->find($_POST["id"]);
			//p($predata);
			//p($_POST);
			if($_POST["contacts"]==NULL){
				$_POST["contacts"]="无";
			}
			if($_POST["phonenum"]==NULL){
				$_POST["phonenum"]="无";
			}
			if($_POST["address"]==NULL){
				$_POST["address"]="无";
			}
			if($predata==$_POST){
                               	$this->error("数据相同，没有修改！",3,"index");
			}else{
				$result=$cus->update();
				//p($result);
                        	if($result){
                                	$this->success("修改客户信息成功！",1,"index");
                        	}else{
                                	$this->error($cus->getMsg(),3,"custom/mod/id/{$_POST["id"]}");
				}
			}  
		}
		function del(){
		        $cus=D("custom");  
                        if($cus->delete($_GET["id"])){
                                $this->redirect("index");
                        }else{
                                $this->error($cus->getMsg(),3,"index");
                        }  
		
		}
	
	}

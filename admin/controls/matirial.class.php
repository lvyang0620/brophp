<?php
        class Matirial {
                function index(){
			$mat=D("matirial");
			//p($_GET);	
			if(!empty($_GET["cid"])){
				$cid=$_GET["cid"];
			//}elseif($_GET["cid"]==0){
			//	$cid=0;
			}else{
				$cid=0;
			}
			//p($cid);
			if($cid==0){	//全部数量
				$total=$mat->total();
			}else{		//某类的数量
				$total=$mat->where(array("category_id"=>$cid))->total();
			}
			$cat=D("category");
			$cc=$cat->field("id,name")->select(); 
			$this->assign("cat",$cc);
			
			if($cid==0){
				$cname["name"]="全部";				//当前类名为"全部"
			}else{
				$cname=$cat->field("name")->find($cid);		//设置当前类名	
			}

			$page=new Page($total,10,"cid/{$cid}");			//创建分页
			
			if($cid==0){
				$data=$mat->order("partcode desc")
					  ->limit($page->limit)
					  ->select();
			}else{
				$data=$mat->where(array("category_id"=>$cid))
					  ->order("partcode desc")
					  ->limit($page->limit)
					  ->select();
			}
	
			$this->assign("data",$data);
			$this->assign("fpage",$page->fpage());
			$this->assign("cname",$cname["name"]);
			$this->assign("cid",$cid);
			$this->display();
                }

                function add(){
			$cat=D("category");
			//p($cat->field("id,name")->select());
			$this->assign("cat",$cat->field("id,name")->select());
			
			$sup=D("supplier");
			//p($sup->field("id,name")->select());
			$this->assign("sup",$sup->field("id,name")->select());

			$this->display();
                }
		function insert(){
			$mat=D("matirial");

			//p($_POST);

			$cat=D("category");
			//$cname=$cat->field("name,lossrate,lossclass")->find($_POST["category_id"]);
			$cname=$cat->field("name,lossrate")->find($_POST["category_id"]);
			$_POST["category_name"]=$cname["name"];
			$_POST["lossrate"]=$cname["lossrate"];
			//$_POST["lossclass"]=$cname["lossclass"];
			
			$sup=D("supplier");
			$sname=$sup->field("name")->find($_POST["supplier_id"]);
			$_POST["supplier_name"]=$sname["name"];

			$filename=$mat->upload();
			if(!$filename){
				//p($mat->getMsg());
				//$this->error($mat->getMsg());
				//echo "<script language='text/javascript'>alert('aaa');</script>";
				$_POST["datasheet"]="";
			}else{
				$_POST["datasheet"]=$filename;
			}

			//p($_POST);

			if($mat->insert()){
				$this->success("添加物料成功！",3,"matirial/index/cid/{$_POST["category_id"]}");
			}else{
				$this->error($mat->getMsg(),3,"matirial/add");
			}
                }
                function mod(){
			$mat=D("matirial");
			$data=$mat->find($_GET["partcode"]);
			//p($data);
			$this->assign("data",$data);
			
                        $cat=D("category");		
                        $this->assign("cat",$cat->field("id,name")->select());

                        $sup=D("supplier");		
                        $this->assign("sup",$sup->field("id,name")->select());

			$this->display();
                }
                function update(){
			$mat=D("matirial");
			//p($_POST);	
			//p($_FILES["datasheet"]["error"]);
                        $old_data=$mat->field("partname,description,price,datasheet,category_id,supplier_id")->find($_POST["partcode"]);
                        //p($old_data);


			if($_FILES["datasheet"]["error"]==0){
                        	$filename=$mat->upload();
                        	if(!$filename){
                                	$this->error($mat->getMsg());
                        	}else{
                                	$_POST["datasheet"]=$filename;
                        	}
				$name=PROJECT_PATH."/public/uploads/".$_POST["dfile"];
				p($name);
				if(file_exists($name)){
					unlink($name);
				}
			}
			p($_POST);
			if(!empty($_POST["partname"])){
				$new_data["partname"]=$_POST["partname"];
			}			
			if(!empty($_POST["description"])){
				$new_data["description"]=$_POST["description"];
			}			
			if(!empty($_POST["price"])){
				$new_data["price"]=$_POST["price"];
			}			
			if(!empty($_POST["datasheet"])){
				$new_data["datasheet"]=$_POST["datasheet"];
			}else{
				$new_data["datasheet"]=$old_data["datasheet"];
			}			
			if(!empty($_POST["category_id"])){
				$new_data["category_id"]=$_POST["category_id"];
			}			
			if(!empty($_POST["supplier_id"])){
				$new_data["supplier_id"]=$_POST["supplier_id"];
			}			


			//p($new_data);
			if($old_data==$new_data){
                                $this->error("数据相同，没有修改，请重新填写或放弃修改！",3,"matirial/mod/partcode/{$_POST["partcode"]}");
			}else{
				$cat=D("category");
				$c=$cat->field("name,lossrate,lossclass")->find($_POST["category_id"]);
				$_POST["category_name"]=$c["name"];
				$_POST["lossrate"]=$c["lossrate"];
				$_POST["lossclass"]=$c["lossclass"];

				$sup=D("supplier");
				$s=$sup->field("name")->find($_POST["supplier_id"]);
				$_POST["supplier_name"]=$s["name"];

				
                        	if($mat->update()){
                               		$this->success("修改物料成功！",3,"matirial/index/cid/{$_POST["cid"]}");
                        	}else{
                                	//p($_POST);
                                	$this->error($mat->getMsg(),3,"matirial/mod/partcode/{$_POST["partcode"]}");
                        	}
			}

                }
                function del(){
			//p($_POST);
			//p($_GET);
			$mat=D("matirial");
			if(isset($_POST["partcode"])){
				$partcode=$_POST["partcode"];
				//p($id);
				$name=$mat->field("datasheet")->select($partcode);
				//p($name);
				$num=count($name);
				//p($num);
				for($i=0;$i<$num;$i++){
					$na=PROJECT_PATH."/public/uploads/".$name["{$i}"]["datasheet"];
                                	if(file_exists($na)){
                                        	unlink($na);
                                	}
				}
			}else{
				$partcode=$_GET["partcode"];
				$name=$mat->field("datasheet")->find($partcode);
				$name=PROJECT_PATH."/public/uploads/".$name["datasheet"];
                                if(file_exists($name)){
                                        unlink($name);
                                }

			}
			//p($partcode);
			if($mat->delete($partcode)){
				//$this->redirect("product/index","/cid/{$_GET["cid"]}");
				$this->success("删除物料成功！",3,"matirial/index/cid/{$_GET["cid"]}");
			}else{
				$this->error("删除物料失败！",3,"matirial/index/cid/{$_GET["cid"]}");
			}
                }

        }


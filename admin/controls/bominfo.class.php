<?php
        class Bominfo {
                function index(){
			$bom=D("bominfo");

                        if(!empty($_GET["project_id"])){
                                $pro_id=$_GET["project_id"];
                        }else{
                                $pro_id=0;
                        }

			$pro=D("project");
			$projects=$pro->select();
			$this->assign("pro",$projects);			
			
			if($pro_id==0){
				$total=$bom->total();
			}else{
				$total=$bom->where(array("project_id"=>$pro_id))->total();
			}	
			//p($total);		
                         if($pro_id==0){
                                 $projectname["name"]="全部";                          //当前类名为"全部"
                         }else{
                                 $projectname=$pro->field("name")->find($pro_id);         //设置当前类名  
                         }

				
			$page=new Page($total,10,"project_id/{$pro_id}");			//创建分页
			if($pro_id==0){
				$data=$bom->order("bomcode desc")
				  	->limit($page->limit)
				  	->select();
			}else{
				$data=$bom->where(array("project_id"=>$pro_id))
					->order("bomcode desc")
				  	->limit($page->limit)
				  	->select();
			}	

			$this->assign("data",$data);
			$this->assign("fpage",$page->fpage());
			$this->assign("projectname",$projectname["name"]);
			$this->assign("pro_id",$pro_id);
			$this->display();
                }
		
                function add(){
			//p($_GET);
			if(isset($_GET["project_id"])){
				$this->assign("pro_id",$_GET["project_id"]);
			}else{
				$this->assign("pro_id",0);
			}

			$bom=D("bominfo");
			$pro=D("project");
			$cus=D("custom");
			$customs=$cus->select();
			$projects=$pro->select();

			$this->assign("bom",$bom->select());
			$this->assign("cus",$customs);			
			$this->assign("pro",$projects);			

			$this->display();
                }
		function insert(){
			p($_POST);

			$bom=D("bominfo");

			$_POST["ctime"]=time();
			if(isset($_POST["project_id"])&&($_POST["project_id"]!=0)){
				$pro=D("project");
				$project=$pro->field("id,name")->find($_POST["project_id"]);
				$_POST["projectname"]=$project["name"];
			}else{
				$_POST["projectname"]="";
			}
			if(isset($_POST["custom_id"])&&($_POST["custom_id"]!=0)){
				$cus=D("custom");
				$custom=$cus->field("id,name,shortname")->find($_POST["custom_id"]);
				$_POST["customname"]=$custom["name"];
				$_POST["customshortname"]=$custom["shortname"];
			}else{
				$_POST["customname"]="";
			}
			//p($_POST);

			$temptablename="bro_".$_POST["projectname"].$_POST["pcbtype"].$_POST["pcbversion"].$_POST["customshortname"].$_POST["customproject"]."_".date("YmdHis");
			$tempbomname=$_POST["projectname"].$_POST["pcbtype"].$_POST["pcbversion"].$_POST["customshortname"].$_POST["customproject"]."_".date("YmdHis");
			//p($temptablename);
			if($bom->createBomTable($temptablename)){
				$_POST["bomname"]=$tempbomname;
				$_POST["tablename"]=$temptablename;
			}else{
				$_POST["bomname"]="创建数据表失败";
				$_POST["tablename"]="";
				$this->error("创建数据表失败！",3,"bominfo/add");
			}
			
			if($bom->insert()){
				$this->success("添加新BOM成功！",3,"bominfo/index");
			}else{
				if(isset($_POST["tablename"])){
					$bom->delBomTable($_POST["tablename"]);
				}
				$this->error($bom->getMsg(),3,"bominfo/add");
			}
                }
                function mod(){

			//p($_GET);
			if(isset($_GET["project_id"])){
				$this->assign("pro_id",$_GET["project_id"]);
			}else{
				$this->assign("pro_id",0);
			}
			$bom=D("bominfo");
			$pro=D("project");
			$projects=$pro->field("id,name")->select();
			$this->assign("pro",$projects);			

			$cus=D("custom");
			$customs=$cus->field("id,name")->select();
			$this->assign("cus",$customs);			

			$data=$bom->find($_GET["bomcode"]);
			//p($data);
			$this->assign("data",$data);

			$this->display();
                }
                function update(){
			p($_POST);	
			$bom=D("bominfo");
                        $old_data=$bom->field("bomcode,description,project_id,projectname,pcbtype,pcbversion,custom_id,customname,customproject")->find($_POST["bomcode"]);
                        p($old_data);
			
			if(!empty($_POST["bomcode"])){
				$new_data["bomcode"]=$_POST["bomcode"];
			}			
			if(!empty($_POST["description"])){
				$new_data["description"]=$_POST["description"];
			}			
			if(!empty($_POST["project_id"])){
				$new_data["project_id"]=$_POST["project_id"];
				$name=D("project")->field("name")->find($_POST["project_id"]);
				//p($name);
				$new_data["projectname"]=$name["name"];			//获取项目名
				$_POST["projectname"]=$name["name"];
				//p($new_data["projectname"]);
			}			
			if(!empty($_POST["pcbtype"])){
				$new_data["pcbtype"]=$_POST["pcbtype"];
			}	
			if(!empty($_POST["pcbversion"])){
				$new_data["pcbversion"]=$_POST["pcbversion"];
			}			
			if(!empty($_POST["custom_id"])){
				$new_data["custom_id"]=$_POST["custom_id"];
				$name=D("custom")->field("name,shortname")->find($_POST["custom_id"]);		//获取客户名
				//p($name);
				$new_data["customname"]=$name["name"];
				$_POST["customname"]=$name["name"];
				$_POST["customshortname"]=$name["shortname"];
				//p($new_data["customname"]);
			}			
			if(!empty($_POST["customproject"])){
				$new_data["customproject"]=$_POST["customproject"];
			}			
			

			p($new_data);
                        p($_POST);
			
			if($old_data==$new_data){
                                $this->error("BOM信息相同，没有修改，请重新填写或放弃修改！",3,"bominfo/mod/bomcode/{$_POST["bomcode"]}");
			}else{
                        	$old_tablename=$bom->field("tablename")->find($_POST["bomcode"]);
				$oldtablename=$old_tablename["tablename"];
				p($oldtablename);
				if($bom->delBomTable($oldtablename)){				//删除旧的数据表
					//p("删除数据表成功！");
				}else{
					p("删除数据表失败！");
					//$this->error("删除数据表失败！",3,"bominfo/index/cid");
				}
				
				$temptablename="bro_".$_POST["projectname"].$_POST["pcbtype"].$_POST["pcbversion"].$_POST["customshortname"].$_POST["customproject"]."_".date("YmdHis");
				$tempbomname=$_POST["projectname"].$_POST["pcbtype"].$_POST["pcbversion"].$_POST["customshortname"].$_POST["customproject"]."_".date("YmdHis");
				//p($temptablename);
				p($temptablename);
				if($bom->createBomTable($temptablename)){			//创建新数据表
					$_POST["bomname"]=$tempbomname;
					$_POST["tablename"]=$temptablename;
				}else{
					$_POST["bomname"]="创建数据表失败";
					$_POST["tablename"]="";
					$this->error("创建数据表失败！",3,"bominfo/add");
				}
				$_POST["lastmodtime"]=time();

					
                        	if($bom->update()){
                               		$this->success("修改BOM信息成功！",1,"bominfo/index");
                        	}else{
                                	//p($_POST);
                                	$this->error($bom->getMsg(),3,"bominfo/mod/bomcode/{$_POST["bomcode"]}");
                        	}
				
			}
			
                }
                function del(){
			//p($_POST);
			//p($_GET);
			$bom=D("bominfo");
			if(isset($_POST["bomcode"])){
				$bomcode=$_POST["bomcode"];
			}else{
				$bomcode=$_GET["bomcode"];
			}
			$bomitem=$bom->field("tablename")->find($bomcode);
			if($bom->delBomTable($bomitem["tablename"])){
				//p("删除数据表成功！");
			}else{
				p("删除数据表失败！");
				//$this->error("删除数据表失败！",3,"bominfo/index/cid");
			}
			
			if($bom->delete($bomcode)){
				$this->success("删除BOM成功！",3,"bominfo/index");
			}else{
				$this->error("删除BOM失败！",3,"bominfo/index");
			}
                }

        }


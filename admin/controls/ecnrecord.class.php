<?php
        class Ecnrecord {
                function index(){
                        $bomcode=$_GET["bomcode"];
                        //p($bomcode);
                        $bom=D("bominfo");

                        $bomitem=$bom->field("bomname,ecnrecord")->find($bomcode);
                        $bomname=$bomitem["bomname"];
                        $ecnrectablename=$bomitem["ecnrecord"];
                        //p($tablename);
                        $tab=D();
                        $sql="select count(1) from {$ecnrectablename};";
                        $total=$tab->query($sql,"total");               //获取总数
                        //p($total);
                        $page=new Page($total,10);                      //创建分页

                        $sql="select item,ecn_num,description,ecntime from {$ecnrectablename};";
                        $data=$tab->query($sql,"select");               //查询数据
                        //p($data);

                        $this->assign("bomcode",$bomcode);                    //分配数据
                        $this->assign("bomname",$bomname);                    //分配数据
                        $this->assign("data",$data);                    //分配数据
                        $this->assign("fpage",$page->fpage());

                        $this->display();

                }
		
                function add(){
			//p($_GET);
			$bom=D("bominfo");
			$bominfo=$bom->field("bomcode,bomname,ecnrecord")->find($_GET["bomcode"]);
			//p($bominfo);
			$this->assign("bomcode",$bominfo["bomcode"]);
			$this->assign("bomname",$bominfo["bomname"]);
			$this->assign("ecnrectablename",$bominfo["ecnrecord"]);
			
			$this->display();
                }
		function insert(){
			$bom=D("bominfo");

			p($_POST);

			if(isset($_POST["bomcode"])){
				$bomcode=$_POST["bomcode"];
			}elseif(isset($_GET["bomcode"])){
				$bomcode=$_GET["bomcode"];
			}
			$bominfo=$bom->field("ecnrecord")->find($bomcode);
			$ecnrectablename=$bominfo["ecnrecord"];
			//p($tablename);
			$_POST["ecntime"]=time();			

			$tab=D();
		
                        $sql='insert into '.$ecnrectablename.'(ecn_num,description,ecntime) values("'.$_POST["ecn_num"].'","'.$_POST["description"].'","'.$_POST["ecntime"].'");';
			p($sql);
                        $result=$tab->query($sql,"insert");               //插入数据
			//p($result);
			if($result){
				$this->success("添加ECN 记录进成功！",3,"ecnrecord/index/bomcode/{$bomcode}");
			}else{
				$this->error($tab->getMsg(),3,"ecnrecord/add");
			}
			
                }
                function mod(){
			//p($_GET);
			$bom=D("bominfo");
			$bominfo=$bom->field("bomcode,bomname,tablename")->find($_GET["bomcode"]);
			//p($bominfo);
			$this->assign("bomcode",$bominfo["bomcode"]);
			$this->assign("bomname",$bominfo["bomname"]);

			$tablename=$bominfo["tablename"];
                        $tab=D();
                        $sql='select partcode,num,refs,substitute,accounting from '.$tablename.' where partcode="'.$_GET["partcode"].'";';
                        //p($sql);
                        $data=$tab->query($sql,"select");               //插入数据
                        //p($data);
			$partcode=$data[0]["partcode"];
			$num=$data[0]["num"];
			$refs=$data[0]["refs"];
			$substitute=$data[0]["substitute"];
			$accounting=$data[0]["accounting"];
			//p($accounting);
			$this->assign("partcode",$partcode);
			$this->assign("num",$num);
			$this->assign("refs",$refs);
			$this->assign("substitute",$substitute);
			$this->assign("accounting",$accounting);
			$this->display();
                }
                function update(){
			//p($_POST);	
			//p($_GET);
			$bom=D("bominfo");
			$bominfo=$bom->field("bomcode,bomname,tablename")->find($_GET["bomcode"]);
			$tablename=$bominfo["tablename"];
			$tab=D();
			$sql='select partcode,num,refs,substitute,accounting from '.$tablename.' where partcode="'.$_POST["partcode"].'";';
			//p($sql);
                        //p($_POST);
                        $data=$tab->query($sql,"select");
			$old_data=$data[0];
                        //p($old_data);
			
			if(!empty($_POST["partcode"])){
				$new_data["partcode"]=$_POST["partcode"];
			}			
			if(!empty($_POST["num"])){
				$new_data["num"]=$_POST["num"];
			}			
			if(!empty($_POST["refs"])){
				$new_data["refs"]=$_POST["refs"];
			}			
			if(!empty($_POST["substitute"])){
				$new_data["substitute"]=$_POST["substitute"];
			}
			//p($_POST["accounting"]);
			if(!empty($_POST["accounting"])){
				$new_data["accounting"]=1;
				$_POST["accounting"]=1;
			}else{
				$new_data["accounting"]=0;
				$_POST["accounting"]=0;
			}			

			//p($new_data);
			//p($_POST);
			
			if($old_data==$new_data){		//判断数据是否修改
                                $this->error("数据相同，没有修改，请重新填写或放弃修改！",3,"detailpart/mod/bomcode/{$_GET["bomcode"]}/partcode/{$_POST["partcode"]}");
			}else{
				
				$sql='update '.$tablename.' set partcode="'.$_POST["partcode"].'",num="'.$_POST["num"].'",refs="'.$_POST["refs"].'",substitute="'.$_POST["substitute"].'",accounting="'.$_POST["accounting"].'"  where partcode="'.$_POST["partcode"].'";';
				//p($sql);
                        	$result=$tab->query($sql,"update");               //更新数据
				//p($result);
				
                        	if($result){
                               		$this->success("修改BOM中物料成功！",1,"detailpart/index/bomcode/{$_GET["bomcode"]}");
                        	}else{
                                	//p($_POST);
                                	$this->error($tab->getMsg(),3,"detailpart/mod/bomcode/{$_GET["bomcode"]}/partcode/{$_POST["partcode"]}");
                        	}
				
			}
				

                }

		function import(){

		}

		function export(){

		}

                function del(){
			//p($_GET);
			$bom=D("bominfo");
			if(isset($_POST["bomcode"])){
				$bomcode=$_POST["bomcode"];
			}else{
				$bomcode=$_GET["bomcode"];
			}
			$bomitem=$bom->field("tablename")->find($bomcode);
			$tablename=$bomitem["tablename"];
			//p($tablename);
			$tab=D();
			$sql='delete from '.$tablename.' where partcode="'.$_GET["partcode"].'";';
			//p($sql);
			$result=$tab->query($sql,"delete");	
			
			if($result){
				$this->success("删除器件项成功！",3,"detailpart/index/bomcode/{$bomcode}");
			}else{
				$this->error("删除器件项失败！",3,"detailpart/index/bomcode/{$bomcode}");
			}
			
			
                }

        }


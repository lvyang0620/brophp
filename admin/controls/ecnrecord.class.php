<?php
        class Ecnrecord {
                function index(){
			//p($_GET);
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

                        $sql="select item,ecn_num,ecn_detail_tablename,description,ecntime from {$ecnrectablename};";
                        $data=$tab->query($sql,"select");               //查询数据
                        //p($data);

                        	$this->assign("bomcode",$bomcode);                    //分配数据
                        	$this->assign("bomname",$bomname);                    //分配数据
                        	$this->assign("data",$data);                    //分配数据
                        	$this->assign("fpage",$page->fpage());
			if(isset($_GET["ecn_detail_tablename"]) && isset($_GET["ecn_num"])){
				$this->assign("ecn_num",$_GET["ecn_num"]);
				$ecn_detail=D();
				$ecn_detail_tablename=$_GET["ecn_detail_tablename"];
				$sql2="select item,reason,description,act,partcode,new_num,new_refs,new_substitute,action_type,oldpart_dealing from {$ecn_detail_tablename};";
				$ecn_detail_data=$ecn_detail->query($sql2,"select");
				//p($ecn_detail_data);
				$this->assign("ecn_detail_data",$ecn_detail_data);
				//$this->redirect("index_detail");
                        	$this->display("index_detail");

			}else{
                        	$this->display("index");
			}

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

			//p($_POST);
			if(isset($_POST["bomcode"])){
				$bomcode=$_POST["bomcode"];
			}elseif(isset($_GET["bomcode"])){
				$bomcode=$_GET["bomcode"];
			}
			$bominfo=$bom->field("bomname,ecnrecord")->find($bomcode);
			$ecnrectablename=$bominfo["ecnrecord"];
			$bomname=$bominfo["bomname"];
			//p($bomname);

			//取得ECN明细表名
			$ecn_detail_tablename="bro_ECN_DETAIL_".$_POST["ecn_num"]."_".$bomname;
			p($ecn_detail_tablename);
			//创建变更明细表
                        if($bom->createEcnDetailTable($ecn_detail_tablename)){
				p("创建变更明细表成功");
                                $_POST["ecn_detail_tablename"]=$ecn_detail_tablename;
				//执行插入变更明细表操作
				for($i=1;$i<=$_POST["count"];$i++){
					$item=$i;
					if(isset($_POST["reason{$i}"])){
						$reason=$_POST["reason{$i}"];
					}
					if(isset($_POST["description{$i}"])){
						$description=$_POST["description{$i}"];
					}
					if(isset($_POST["act{$i}"])){
						$act=$_POST["act{$i}"];
					}
					if(isset($_POST["partcode{$i}"])){
						$partcode=$_POST["partcode{$i}"];
					}
					if(isset($_POST["new_num{$i}"])){
						$new_num=$_POST["new_num{$i}"];
					}
					if(isset($_POST["new_refs{$i}"])){
						$new_refs=$_POST["new_refs{$i}"];
					}
					if(isset($_POST["new_substitute{$i}"])){
						$new_substitute=$_POST["new_substitute{$i}"];
					}
					if(isset($_POST["action_type{$i}"])){
						$action_type=$_POST["action_type{$i}"];
					}
					if(isset($_POST["oldpart_dealing{$i}"])){
						$oldpart_dealing=$_POST["oldpart_dealing{$i}"];
					}
					//插入变更明细表数据
					$ecndetail=D();
					$sql1='insert into '.$ecn_detail_tablename.'(item,reason,description,act,partcode,new_num,new_refs,new_substitute,action_type,oldpart_dealing) values("'.$item.'","'.$reason.'","'.$description.'","'.$act.'","'.$partcode.'","'.$new_num.'","'.$new_refs.'","'.$new_substitute.'","'.$action_type.'","'.$oldpart_dealing.'");';
					//p($sql1);
					 $result1=$ecndetail->query($sql1,"insert");               //插入数据
                        		//p($result);
                        		if($result1){
						p("插入ECN明细表 {$ecn_detail_tablename} 成功");
                        		}else{
                                		$this->error("插入ECN明细表 {$ecn_detail_tablename} 失败",3,"ecnrecord/add");
                        		}
				}
                        }else{
				p("创建ECN变更明细表失败！");
                                $_POST["ecn_detail_tablename"]="";
                                $this->error("创建ECN变更明细表失败！",3,"bominfo/add");
                        }
				

			$_POST["ecntime"]=time();			

			$tab=D();
		
                        $sql='insert into '.$ecnrectablename.'(ecn_num,ecn_detail_tablename,description,ecntime) values("'.$_POST["ecn_num"].'","'.$_POST["ecn_detail_tablename"].'","'.$_POST["description"].'","'.$_POST["ecntime"].'");';
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
			p($_GET);
			//删除该ECN单号对应的明细表
			if(isset($_GET["ecn_detail_tablename"])){
				$ecn_detail_tablename=$_GET["ecn_detail_tablename"];
				$bom=D("bominfo");
				if($bom->delBomTable($ecn_detail_tablename)){
					p("删除ECN明细表{$ecn_detail_tablename}成功！");
				}else{
					p("删除ECN明细表{$ecn_detail_tablename}失败！");
				}
			}			
			
			$bom=D("bominfo");
			if(isset($_POST["bomcode"])){
				$bomcode=$_POST["bomcode"];
			}else{
				$bomcode=$_GET["bomcode"];
			}
			$bomitem=$bom->field("ecnrecord")->find($bomcode);
			$tablename=$bomitem["ecnrecord"];
			//p($tablename);
			$tab=D();

			//删除该ECN单号
			$sql='delete from '.$tablename.' where item="'.$_GET["ecn_item"].'";';
			//p($sql);
			$result=$tab->query($sql,"delete");	
			
			if($result){
				$this->success("删除ECN单成功！",1,"ecnrecord/index/bomcode/{$bomcode}");
			}else{
				$this->error("删除ECN单项失败！".$tab->getMsg(),3,"ecnrecord/index/bomcode/{$bomcode}");
			}
                }

        }


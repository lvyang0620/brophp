<?php
        class Ecn {
                function index(){
				//p($_GET);
                        	$pro=D("project");
                        	$projects=$pro->select();
                        	$this->assign("pro",$projects);			
                        	if(!empty($_GET["project_id"])){
                                	$pro_id=$_GET["project_id"];
                        	}else{
                                	$pro_id=0;
                        	}
                         	if($pro_id==0){
                                	 $projectname["name"]="全部";                          //当前项目名为"全部"
                         	}else{
                                 	$projectname=$pro->field("name")->find($pro_id);         //设置当前项目名  
                         	}
				$this->assign("projectname",$projectname["name"]);
                        	$bom=D("bominfo");
                        	if($pro_id==0){
                                	$bominfo=$bom->field("bomcode,bomname")
						->order("bomcode desc")
                                        	->select();
                        	}else{
                                	$bominfo=$bom->field("bomcode,bomname")
						->where(array("project_id"=>$pro_id))
                                        	->order("bomcode desc")
                                        	->select();
                        	}
				$this->assign("bominfo",$bominfo);

                        	if(!empty($_GET["bomname"])){
                                	$bomname=$_GET["bomname"];
                        	}else{
                                	$bomname=null;
                        	}
				//p($bomname);
				if($bomname){
					//从当前项目的指定BOM中列出ECN DETAIL明细表
                                	$all_ecn=D("all_ecn_detail_list");
                                	$total=$all_ecn->total();               //获取总数
                                	//p($total);
                                	$page=new Page($total,10);                      //创建分页
                        		$data=$all_ecn->where(array("bomname"=>$bomname))->select();
                                	//p($data);
				}elseif(isset($_GET["project_id"]) && $_GET["project_id"]!=0){
					//从当前项目的所有BOM中列出所有的ECN DETAIL明细表
                                	$all_ecn=D("all_ecn_detail_list");
                                	$total=$all_ecn->total();               //获取总数
                                	//p($total);
                                	$page=new Page($total,10);                      //创建分页
                        		//$data=$all_ecn->where("projectname"=>$projectname["name"])->select();
                        		$data=$all_ecn->where(array("projectname"=>$projectname["name"]))->select();
					//p($data);
				
				}else{
					//从当前项目的所有BOM中列出所有的ECN DETAIL明细表
                                	$all_ecn=D("all_ecn_detail_list");
                                	$total=$all_ecn->total();               //获取总数
                                	//p($total);
                                	$page=new Page($total,10);                      //创建分页
                        		$data=$all_ecn->select();
					//p($data);
				
				}
                                $this->assign("bomname",$bomname);                    //分配数据
                                $this->assign("data",$data);                    //分配数据
                                $this->assign("fpage",$page->fpage());
				$this->assign("pro_id",$pro_id);

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

			//p($_POST);
			if(isset($_POST["bomcode"])){
				$bomcode=$_POST["bomcode"];
			}elseif(isset($_GET["bomcode"])){
				$bomcode=$_GET["bomcode"];
			}
			$bominfo=$bom->field("bomname,tablename,ecnrecord")->find($bomcode);
			$ecnrectablename=$bominfo["ecnrecord"];
			$bomname=$bominfo["bomname"];
			$tablename=$bominfo["tablename"];
			//p($bomname);

			//取得ECN明细表名
			$ecn_detail_tablename="bro_ECN_DETAIL_".$_POST["ecn_num"]."_".$bomname;
			//p($ecn_detail_tablename);
			//创建变更明细表
                        if($bom->createEcnDetailTable($ecn_detail_tablename)){
				//p("创建变更明细表成功");
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
					$bom_part=D();
					$sql_bom_part="select num,refs,substitute from {$tablename} where partcode={$partcode};";
					$result_bom_part=$bom_part->query($sql_bom_part,"select");
					if(!empty($_POST["new_num{$i}"])){
						$new_num=$_POST["new_num{$i}"];
					}else{
						if($result_bom_part){
							$new_num=$result_bom_part[0]["num"];
						}else{
							p("BOM中没有找到此物料编码：{$partcode}");
						}
					}
					p($_POST["new_refs{$i}"]);
					if(!empty($_POST["new_refs{$i}"])){
						$new_refs=$_POST["new_refs{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_refs=$result_bom_part[0]["refs"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }

					if(!empty($_POST["new_substitute{$i}"])){
						$new_substitute=$_POST["new_substitute{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_substitute=$result_bom_part[0]["substitute"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }

					if(isset($_POST["action_type{$i}"])){
						$action_type=$_POST["action_type{$i}"];
					}
					if(isset($_POST["oldpart_dealing{$i}"])){
						$oldpart_dealing=$_POST["oldpart_dealing{$i}"];
					}
					//插入变更明细表数据
					$ecndetail=D();
					$sql1='insert into '.$ecn_detail_tablename.' (item,reason,description,act,partcode,new_num,new_refs,new_substitute,action_type,oldpart_dealing) values("'.$item.'","'.$reason.'","'.$description.'","'.$act.'","'.$partcode.'","'.$new_num.'","'.$new_refs.'","'.$new_substitute.'","'.$action_type.'","'.$oldpart_dealing.'");';
					//p($sql1);
					 $result1=$ecndetail->query($sql1,"insert");               //插入数据
                        		//p($result);
                        		if($result1){
						p("插入ECN明细表 {$ecn_detail_tablename} 成功");
                        		}else{
                                		$this->error("插入ECN明细表 {$ecn_detail_tablename} 失败",3,"ecnrecord/add");
                        		}

					//插入所有ECN修改记录和修改明细表后，修改对应的BOM内容
					$update_bom=D();
					$sql_update_bom='update '.$tablename.' set num="'.$new_num.'",refs="'.$new_refs.'",substitute="'.$new_substitute.'"  where partcode="'.$partcode.'";';
					p($sql_update_bom);	
					$result_update_bom=$update_bom->query($sql_update_bom,"query");
					if($result_update_bom){
						p("依据ECN内容更新BOM的{$partcode}器件内容成功");
					}else{
						p("依据ECN内容更新BOM的{$partcode}器件内容失败");
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
			//p($sql);
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
			if(isset($_GET["ecn_item"])){
				$bom=D("bominfo");
				$bomcode=$_GET["bomcode"];
				$bominfo=$bom->field("bomname,ecnrecord")->find($bomcode);
				$bomname=$bominfo["bomname"];
				$ecnrecord=$bominfo["ecnrecord"];
				$ecn_item=$_GET["ecn_item"];
				$ecn=D();
				$sql1="select item,ecn_num,ecn_detail_tablename,description from {$ecnrecord} where item=".'"'.$ecn_item.'";';
				//p($sql1);
				$ecnrec=$ecn->query($sql1,"select");
				$ecn_item=$ecnrec[0]["item"];
				$ecn_num=$ecnrec[0]["ecn_num"];
				$description=$ecnrec[0]["description"];
				$ecn_detail_tablename=$ecnrec[0]["ecn_detail_tablename"];

				$ecn_detail=D();
				$sql2="select item,reason,description,act,partcode,new_num,new_refs,new_substitute,action_type,oldpart_dealing from {$ecn_detail_tablename};";
				$data=$ecn_detail->query($sql2,"select");
				//p($data);
				$this->assign("data",$data);

				$this->assign("bomcode",$bomcode);
				$this->assign("bomname",$bomname);
				$this->assign("ecn_item",$ecn_item);
				$this->assign("ecn_num",$ecn_num);
				$this->assign("description",$description);
				$this->assign("ecn_detail_tablename",$ecn_detail_tablename);
				$this->display();	
			}else{
				p("ecn_item传送错误");
			}			
                }
        	function update(){
			//p($_POST);	
			//p($_GET);
			$bom=D("bominfo");
			if(isset($_POST["bomcode"])){
				$bomcode=$_POST["bomcode"];
			}elseif(isset($_GET["bomcode"])){
				$bomcode=$_GET["bomcode"];
			}
			$bominfo=$bom->field("bomname,tablename,ecnrecord")->find($bomcode);
			$ecnrectablename=$bominfo["ecnrecord"];
			$bomname=$bominfo["bomname"];
			$tablename=$bominfo["tablename"];
			//取得ECN明细表名
			$ecn=D();
			$sql2="select ecn_detail_tablename from ".$ecnrectablename.' where ecn_num="'.$_POST["ecn_num"].'";';
			//p($sql2);
			$ecn_rec=$ecn->query($sql2,"select");
			//p($ecn_rec);
			$ecn_detail_tablename=$ecn_rec[0]["ecn_detail_tablename"];
			//p($ecn_detail_tablename);
			$ecndetail=D();
			$sql='select count(1) from '.$ecn_detail_tablename.';';		//获取原明细表的行数
			$oldcount=$ecndetail->query($sql,"total");

            		if($_POST["count"]>=$oldcount){						//修改的ECN行数大于等于原来的ECN明细单修改的行数
				//先更新已有数据，再插入新增的ECN修改数据
				//1，先更新已有数据
                		$_POST["ecn_detail_tablename"]=$ecn_detail_tablename;
				//执行插入变更明细表操作
				for($i=1;$i<=$oldcount;$i++){
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

					$bom_part=D();
                                        $sql_bom_part="select num,refs,substitute from {$tablename} where partcode={$partcode};";
                                        $result_bom_part=$bom_part->query($sql_bom_part,"select");

					if(!empty($_POST["new_num{$i}"])){
						$new_num=$_POST["new_num{$i}"];
					}else{
						if($result_bom_part){
							$new_num=$result_bom_part[0]["num"];
						}else{
							p("BOM中没有找到此物料编码：{$partcode}");
						}
					}
				
					if(!empty($_POST["new_refs{$i}"])){
						$new_refs=$_POST["new_refs{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_refs=$result_bom_part[0]["refs"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }
					
					if(!empty($_POST["new_substitute{$i}"])){
						$new_substitute=$_POST["new_substitute{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_substitute=$result_bom_part[0]["substitute"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }
					
					if(isset($_POST["action_type{$i}"])){
						$action_type=$_POST["action_type{$i}"];
					}
					if(isset($_POST["oldpart_dealing{$i}"])){
						$oldpart_dealing=$_POST["oldpart_dealing{$i}"];
					}
					
					//插入变更明细表数据
					$ecndetail=D();
					//$sql1='update '.$ecn_detail_tablename.' set item="'.$item.'",reason="'.$_POST["reason{$i}"].'",description="'.$_POST["description{$i}"].'",act="'.$_POST["act{$i}"].'",partcode="'.$_POST["partcode{$i}"].'",new_num="'.$_POST["new_num{$i}"].'",new_refs="'.$_POST["new_refs{$i}"].'",new_substitute="'.$_POST["new_substitute{$i}"].'",action_type="'.$_POST["action_type{$i}"].'",oldpart_dealing="'.$_POST["oldpart_dealing{$i}"].'"  where item="'.$item.'";';
					$sql1='update '.$ecn_detail_tablename.' set item="'.$item.'",reason="'.$reason.'",description="'.$description.'",act="'.$act.'",partcode="'.$_POST["partcode{$i}"].'",new_num="'.$new_num.'",new_refs="'.$new_refs.'",new_substitute="'.$new_substitute.'",action_type="'.$action_type.'",oldpart_dealing="'.$oldpart_dealing.'"  where item="'.$item.'";';
					
					//p($sql1);					
					 $result1=$ecndetail->query($sql1,"update");               //插入数据
                        		//p($result);
                        		if($result1){
						p("ECN明细表 {$ecn_detail_tablename} 第{$i}行数据修改成功！");
                        		}else{
                                		p("ECN明细表 {$ecn_detail_tablename} 第{$i}行数据没有修改！");
                        		}
					
					//修改所有ECN修改记录和修改明细表后，修改对应的BOM内容
					$update_bom=D();
					$sql_update_bom='update '.$tablename.' set num="'.$new_num.'",refs="'.$new_refs.'",substitute="'.$new_substitute.'"  where partcode="'.$partcode.'";';
					p($sql_update_bom);	
					$result_update_bom=$update_bom->query($sql_update_bom,"query");
					if($result_update_bom){
						p("依据ECN内容更新BOM的{$partcode}器件内容成功");
					}else{
						p("依据ECN内容更新BOM的{$partcode}器件内容失败");
					}	
				}
			//2，插入新增的ECN修改数据行
			//$add_count=$_POST["count"]-$oldcount;
			for($i=$oldcount+1;$i<=$_POST["count"];$i++){
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

					$bom_part=D();
                                        $sql_bom_part="select num,refs,substitute from {$tablename} where partcode={$partcode};";
                                        $result_bom_part=$bom_part->query($sql_bom_part,"select");
					p($result_bom_part);
					if(!empty($_POST["new_num{$i}"])){
						$new_num=$_POST["new_num{$i}"];
					}else{
						if($result_bom_part){
							$new_num=$result_bom_part[0]["num"];
						}else{
							p("BOM中没有找到此物料编码：{$partcode}");
						}
					}
				
					if(!empty($_POST["new_refs{$i}"])){
						$new_refs=$_POST["new_refs{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_refs=$result_bom_part[0]["refs"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }
					
					if(!empty($_POST["new_substitute{$i}"])){
						$new_substitute=$_POST["new_substitute{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_substitute=$result_bom_part[0]["substitute"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }
					
					if(isset($_POST["action_type{$i}"])){
						$action_type=$_POST["action_type{$i}"];
					}
					if(isset($_POST["oldpart_dealing{$i}"])){
						$oldpart_dealing=$_POST["oldpart_dealing{$i}"];
					}
					//插入变更明细表数据
					$ecndetail=D();
					$sql1='insert into '.$ecn_detail_tablename.' (item,reason,description,act,partcode,new_num,new_refs,new_substitute,action_type,oldpart_dealing) values("'.$item.'","'.$reason.'","'.$description.'","'.$act.'","'.$partcode.'","'.$new_num.'","'.$new_refs.'","'.$new_substitute.'","'.$action_type.'","'.$oldpart_dealing.'");';
					//p($sql1);
					 $result1=$ecndetail->query($sql1,"insert");               //插入数据
                        		//p($result);
                        		if($result1){
									p("在ECN明细表 {$ecn_detail_tablename} 中新插入第{$i}行数据成功！");
                        		}else{
                                	//$this->error("插入ECN明细表 {$ecn_detail_tablename} 失败",3,"ecnrecord/add");
									p("在ECN明细表 {$ecn_detail_tablename} 中新插入第{$i}行数据失败！");
                        		}
								
					//插入所有ECN修改记录和修改明细表后，修改对应的BOM内容
					$update_bom=D();
					$sql_update_bom='update '.$tablename.' set num="'.$new_num.'",refs="'.$new_refs.'",substitute="'.$new_substitute.'"  where partcode="'.$partcode.'";';
					p($sql_update_bom);	
					$result_update_bom=$update_bom->query($sql_update_bom,"query");
					if($result_update_bom){
						p("依据ECN内容更新BOM的{$partcode}器件内容成功");
					}else{
						p("依据ECN内容更新BOM的{$partcode}器件内容失败");
					}
				}
				
            		}elseif($_POST["count"]<$oldcount){    //修改的ECN行数小于原来ECN明细表里的行数
				//先更新，再删除
				//1，更新已有数据
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

					$bom_part=D();
                                        $sql_bom_part="select num,refs,substitute from {$tablename} where partcode={$partcode};";
                                        $result_bom_part=$bom_part->query($sql_bom_part,"select");

					if(!empty($_POST["new_num{$i}"])){
						$new_num=$_POST["new_num{$i}"];
					}else{
						if($result_bom_part){
							$new_num=$result_bom_part[0]["num"];
						}else{
							p("BOM中没有找到此物料编码：{$partcode}");
						}
					}
				
					if(!empty($_POST["new_refs{$i}"])){
						$new_refs=$_POST["new_refs{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_refs=$result_bom_part[0]["refs"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }
					
					if(!empty($_POST["new_substitute{$i}"])){
						$new_substitute=$_POST["new_substitute{$i}"];
					}else{
                                                if($result_bom_part){
                                                        $new_substitute=$result_bom_part[0]["substitute"];
                                                }else{
                                                        p("BOM中没有找到此物料编码：{$partcode}");
                                                }
                                        }
					
					if(isset($_POST["action_type{$i}"])){
						$action_type=$_POST["action_type{$i}"];
					}
					if(isset($_POST["oldpart_dealing{$i}"])){
						$oldpart_dealing=$_POST["oldpart_dealing{$i}"];
					}
					
					//插入变更明细表数据
					$ecndetail=D();					
					$sql1='update '.$ecn_detail_tablename.' set item="'.$item.'",reason="'.$reason.'",description="'.$description.'",act="'.$act.'",partcode="'.$_POST["partcode{$i}"].'",new_num="'.$new_num.'",new_refs="'.$new_refs.'",new_substitute="'.$new_substitute.'",action_type="'.$action_type.'",oldpart_dealing="'.$oldpart_dealing.'"  where item="'.$item.'";';

					//p($sql1);					
					 $result1=$ecndetail->query($sql1,"update");               //插入数据
                        		//p($result);
                        		if($result1){
						p("在ECN明细表 {$ecn_detail_tablename} 中修改第{$i}行数据成功！");
                        		}else{
                                		p("在ECN明细表 {$ecn_detail_tablename} 中，没有修改第{$i}行数据！");
                        		}
								
					//修改所有ECN修改记录和修改明细表后，修改对应的BOM内容
					$update_bom=D();
					$sql_update_bom='update '.$tablename.' set num="'.$new_num.'",refs="'.$new_refs.'",substitute="'.$new_substitute.'"  where partcode="'.$partcode.'";';
					p($sql_update_bom);	
					$result_update_bom=$update_bom->query($sql_update_bom,"query");
					if($result_update_bom){
						p("依据ECN内容更新BOM的{$partcode}器件内容成功");
					}else{
						p("依据ECN内容更新BOM的{$partcode}器件内容失败");
					}				
				
				}
				//2，删除之前多余的行
				for($i=$_POST["count"]+1;$i<=$oldcount;$i++){
					$item=$i;
					$ecndetail=D();					
					$sql1='delete from '.$ecn_detail_tablename.' where item="'.$item.'";';
					//p($sql1);					
					$result1=$ecndetail->query($sql1,"delete");               //插入数据
                        		//p($result);
                        		if($result1){
						p("在ECN明细表 {$ecn_detail_tablename} 中删除第{$i}行数据成功！");
                        		}else{
                                		p("在ECN明细表 {$ecn_detail_tablename} 中删除第{$i}行数据失败！");
                        		}
				}
            }
			//修改ECN记录表	
			
			//$_POST["ecntime"]=time();			
			$tab=D();		
			$sql='update '.$ecnrectablename.' set ecn_num="'.$_POST["ecn_num"].'",description="'.$_POST["description"].'",lastmodtime="'.time().'"  where item="'.$_POST["ecn_item"].'";';
			//p($sql);
                        $result=$tab->query($sql,"update");               //修改数据
			//p($result);
			if($result){
				$this->success("修改ECN记录进成功！",3,"ecnrecord/index/bomcode/{$bomcode}");
			}else{
				$this->error($tab->getMsg(),3,"ecnrecord/index/bomcode/{$bomcode}");
			}
		
			//所有ECN修改记录和明细表修改完成后，修改对应的BOM内容			
	
        }

        function del(){
			//p($_GET);
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


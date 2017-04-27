<?php
        class Product {
                function index(){
			$p=D("product");
			
			if(!empty($_GET["cid"])){
				$cid=$_GET["cid"];
				//p($p->where(array("cid"=>$cid))->order("id desc")->select());
				$cid=$_GET["cid"];
			}else{
				//p($p->select());
				$cid=1;
			}
			$cname=D("cat")->field("name")->find($cid);			
			$page=new Page($p->where(array("cid"=>$cid))->total(),5,"cid/{$cid}");			
			$data=$p->field("id,cid,name,num,price,ptime")
				->where(array("cid"=>$cid))
				->order("id desc")
				->limit($page->limit)
				->select();
			
			$this->assign("data",$data);
			$this->assign("fpage",$page->fpage());
			$this->assign("cname",$cname["name"]);
			$this->assign("cid",$cid);
			$this->display();
                }

                function add(){
			$cat=D("cat");
			$this->assign("cat",$cat->field("id,name")->select());

			$this->display();
                }
                function readd(){
			$cat=D("cat");
			$this->assign("cat",$cat->field("id,name")->select());
                        if(!empty($_GET["cid"])){
                                $info["cid"]=$_GET["cid"];
                        }else{
                                $info["cid"]=0;
                        }
                        if(!empty($_GET["name"])){
                                $info["name"]=$_GET["name"];
                        }else{
                                $info["name"]="";
                        }
                        if(!empty($_GET["num"])){
                                $info["num"]=$_GET["num"];
                        }else{
                                $info["num"]="";
                        }
                        if(!empty($_GET["price"])){
                                $info["price"]=$_GET["price"];
                        }else{
                                $info["price"]="";
                        }
                        if(!empty($_GET["desn"])){
                                $info["desn"]=$_GET["desn"];
                        }else{
                                $info["desn"]="";
                        }

			p($info);

			$this->assign("info",$info);
			$this->display();
                }
		
                function insert(){
			$p=D("product");
			$_POST["ptime"]=time();

			$picname=$p->upload();
			if(!$picname){
				$this->error($p->getMsg());
			}else{
			
				$_POST["pic"]=$picname;
			}
			if($p->insert()){
				$this->success("添加商品成功！",3,"product/index/cid/{$_POST["cid"]}");
			}else{
				p($_POST);
				if(empty($_POST["cid"])){
					$_POST["cid"]=0;
				}
				if(empty($_POST["name"])){
					$_POST["name"]=" ";
				}
				if(empty($_POST["num"])){
					$_POST["num"]=0;
				}
				if(empty($_POST["price"])){
					$_POST["price"]=0.0;
				}
				if(empty($_POST["desn"])){
					$_POST["desn"]=" ";
				}
				$this->error($p->getMsg(),3,"product/readd/cid/{$_POST["cid"]}/name/{$_POST["name"]}/num/{$_POST["num"]}/price/{$_POST["price"]}/desn/{$_POST["desn"]}");
			}
                }
                function mod(){
			$p=D("product");
			$data=$p->find($_GET["id"]);
                        $cat=D("cat");
                        $this->assign("cat",$cat->field("id,name")->select());

			$this->assign("data",$data);
			$this->display();
                }
                function update(){
			$p=D("product");
			
			if($_FILES["picture"]["error"]==0){
                        	$picname=$p->upload();
                        	if(!$picname){
                                	$this->error($p->getMsg());
                        	}else{

                                	$_POST["pic"]=$picname;
                        	}
				$name=PROJECT_PATH."/public/uploads/".$_POST["dpic"];
				if(file_exists($name)){
					unlink($name);
				}
			}
                        if($p->update()){
                                $this->success("修改商品成功！",3,"product/index/cid/{$_POST["cid"]}");
                        }else{
                                p($_POST);
                                if(empty($_POST["cid"])){
                                        $_POST["cid"]=0;
                                }
                                if(empty($_POST["name"])){
                                        $_POST["name"]=" ";
                                }
                                if(empty($_POST["num"])){
                                        $_POST["num"]=0;
                                }
                                if(empty($_POST["price"])){
                                        $_POST["price"]=0.0;
                                }
                                if(empty($_POST["desn"])){
                                        $_POST["desn"]=" ";
                                }
                                $this->error($p->getMsg(),3,"product/mod/id/{$_POST["id"]}/name/{$_POST["name"]}/num/{$_POST["num"]}/price/{$_POST["price"]}/desn/{$_POST["desn"]}");
                        }

                }
                function del(){
			$p=D("product");
			if(isset($_POST["id"])){
				$id=$_POST["id"];
				//p($id);
				$name=$p->field("pic")->select($id);
				//p($name);
				$num=count($name);
				//p($num);
				for($i=0;$i<$num;$i++){
					$na=PROJECT_PATH."/public/uploads/".$name["{$i}"]["pic"];
                                	if(file_exists($na)){
                                        	unlink($na);
                                	}
				}
			}else{
				$id=$_GET["id"];
				$name=$p->field("pic")->find($id);
				$name=PROJECT_PATH."/public/uploads/".$name["pic"];
                                if(file_exists($name)){
                                        unlink($name);
                                }

			}
			if($p->delete($id)){
				//$this->redirect("product/index","/cid/{$_GET["cid"]}");
				$this->success("删除商品成功！",3,"product/index/cid/{$_GET["cid"]}");
			}else{
				$this->error("删除商品失败！",3,"product/index/cid/{$_GET["cid"]}");
			}
                }

        }


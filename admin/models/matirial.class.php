<?php
	class Matirial {

		function upload(){
			$up=new FileUpload();
			$up->set("allowtype", array("pdf", "doc", "docx"))
			   ->set("maxsize", 3000000);

			if($up->upload("datasheet")){
				return $up->getFileName();
				
			}else{
				$this->setMsg($up->getErrorMsg());
				return false;
			}
		}
	}

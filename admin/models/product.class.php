<?php
	class Product {
		function upload(){
			$up=new FileUpload();

			if($up->upload("datasheet")){
				return $up->getFileName();
				
			}else{
				$this->setMsg($up->getErrorMsg());
				return false;
			}
		}
	}

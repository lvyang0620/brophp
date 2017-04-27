<?php
	class Index {
		function index(){
			$GLOBALS["debug"]=0;
			$this->display();
		}
		function top(){
			$GLOBALS["debug"]=0;
			$this->display();	
		}		
		function menu(){
			$GLOBALS["debug"]=0;
			$this->display();	
		}		
		function main(){
			$this->display();	
		}		
	}

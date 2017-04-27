<?php
	class Flink{
		function index(){
			p("Flink/index......");
		}
		function add(){
			p("Flink/add......");
			p($_GET["cid"]);
			p($_GET["page"]);
		}
		function mod(){
			p("Flink/mod......");
		}
		function del(){
			p("Flink/del......");
		}
	
	}

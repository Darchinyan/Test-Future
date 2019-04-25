<?php
	$connect=@mysql_connect('localhost','root','')or die('Error Connecting');
	$db_connect=@mysql_select_db('future',$connect);
	mysql_query("SET NAMES 'utf8'");
	if(!$db_connect){
		echo "db connect Error";
	};
?>
<?php
	include 'kon/kon.php';
	$tables=new Tables();
	$mode=$_GET['mode'];
	$query=$_GET['query'];
	if($mode=='index')
	{
		$tables->getsubTaskList(); 
	}
?>
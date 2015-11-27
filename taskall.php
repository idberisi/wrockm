<?php 
	include "kon/kon.php"; 
	$tables=new Tables(); 
	$task=$_POST['task'];
	$query="SELECT d.project_name,c.version_desc,b.task_name,a.subtask_name,a.subtask_desc,a.subtask_in FROM table_task_sub as a inner join table_task as b on a.task_code=b.task_code inner join table_version as c on b.version_code=c.version_code inner join table_project as d on c.project_code=d.project_code ";
	
	if($task=="all")
	{
		$tables->getTableCustomColumnHeader($query."WHERE subtask_out !=0000-00-00 ORDER BY `a`.`subtask_out` DESC","Project Name,Version,Taks Name,Sub Task Name, Sub Task Desc,Date In","CUSTOM",0,0,1);
	}
	else if($task=="pending")
	{
		$tables->getTableCustomColumnHeader($query." where  subtask_out =0000-00-00 ORDER BY `a`.`subtask_out` DESC","Project Name,Version,Taks Name,Sub Task Name, Sub Task Desc,Date In","CUSTOM",0,0,1);
	}
?>
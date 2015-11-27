<!DOCTYPE html>
<?php include "kon/kon.php"; $tables=new Tables(); ?>
<html>

<head>
    <title>WrockM</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
		 <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/clock.js" type="text/javascript"></script>
    <script src="js/menu.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="table_task_sub_insert.js" type="text/javascript"></script>
    <script src="table_task_sub_insert.js" type="text/javascript"></script>
		<link href="css/jquery-ui.css" rel="stylesheet" type="text/css">
		<script src="js/jqueryui.js"></script>
</head>

<body onload="startTime()">
    <nav class="navbar navbar-default navbar-fixed-top" style="background:white">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#" style="color:#33AADA;font-weight:bold;">
						WrockM
					</a>
				</div>
			</div>
		</nav>
    <div id='wrapper'>
        <div id='sidebar'>
            <div id='profil'>
                <center>
                    <div id='photo'>
                    </div>
                    <br> User Name
                </center>
            </div>
            <div id="sidemenu">
                <div id="sidemenu_head">Menu 1</div>
                <ul>
                    <li> Sub Menu 1</li>
                    <li> Sub Menu 2</li>
                    <li> Sub Menu 3</li>
                    <li> Sub Menu 4</li>
                </ul>
            </div>
        </div>

        <div id='chill' class='container-fluid'>
						<div class="row">
							<div class="col-md-6"  style="padding:0">
								<div class="col-md-4">
									<div class="panel pats">
										<center>
                    <div class="p1" id="taskAll">
                        <?php $tables->getScalar("SELECT count(*) FROM `table_task_sub` WHERE subtask_out !=0000-00-00 ORDER BY `task_code` ASC") ?></div>
                    Finished Task
                    <center>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel pats" id="taskPending">
										<center>
                    <div class="p1">
                        <?php $tables->getScalar("SELECT count(*) FROM `table_task_sub` WHERE subtask_out =0000-00-00 || subtask_start =0000-00-00 ORDER BY `task_code` ASC") ?></div>
                    Pending Task
                    <center>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel pats">
										<center>
												<div class="p1">
													<?php $tables->getScalar("SELECT count(*) FROM `table_task_sub` where datediff(CURDATE(),subtask_in)
													<15 ORDER BY `task_code` ASC ") ?>
													<?php //$tables->getFormInsert("table_note") ?>
													<?php //$tables->getInsertFunction("table_note") ?>
												</div>
												Task in Last 15 Days
										<center>
									</div>
								</div>
							</div>
							<div class="col-md-6" style="padding:0">
								<div class="col-md-4">
									<div class="panel pats" style='color:red'>
										<center>
											<div class="p1 "><?php $tables->getScalar("SELECT count(*) FROM `table_task_sub` where datediff(subtask_target,subtask_out)<0 ORDER BY `task_code` ASC ") ?></div>
											Out Off Target
										<center>
									</div>
								</div>
								<div class="col-md-4" style='color:orange'>
									<div class="panel pats">
										<center>
											<div class="p1 "><?php $tables->getScalar("SELECT count(*) FROM `table_task_sub` where datediff(subtask_target,CURDATE())<4 AND subtask_out =0000-00-00 ORDER BY `task_code` ASC ") ?></div>
											Approaching Deadline
                    <center>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel pats">
										<center>
                    <div id="clock"></div>
                    <div id="calender">Friday, Oct 16 2015</div>
                    <center>
									</div>
								</div>
							</div>
						</div>
						<div class="tengah row">
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									<div class="modal-dialog" role="document">
										<div class="modal-content stinsert">
											
										</div>
									</div>
								</div>
						</div>
						<div  class='bawah row'>
						<div class='col-md-6'>
						<div class='col-md-6' style="padding-left:0">
						<div class="panel panel-default">
							<div class="panel-heading">
							
								<h3 class="panel-title">Recent Project
								<button type="button" id="projectadd" class="btn btn-default pull-right">+</button>
								</h3> 
							</div>
							<div class="panel-body">
								<?php $tables->getTableCustomColumnHeader("table_project","project_name",0,0,0,0); ?>
							</div>
						</div>
						</div>
						<div class='col-md-6' style="padding-right:0">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Recent Version<button type="button" id="versionadd" class="btn btn-default pull-right">+</button></h3>
								
							</div>
							<div class="panel-body">
								 <?php $tables->getTableCustomColumnHeader("table_version","version_desc",0,0,0,0); ?>
							</div>
						</div>
						</div>
						</div>
						<div class='col-md-6'>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Recent Task<button type="button" id="subtaskadd" class="btn btn-default pull-right" data-toggle="modal" data-target="#myModal">+</button></h3>
							</div>
							<div class="panel-body">
								 <?php $tables->getTableCustomColumnHeader("table_task_sub","subtask_desc",0,"0,3","subtask_in",0); 
												
								 ?>
							</div>
						</div>
						</div>
        </div>
				
				<div class="container-fluid" style="padding:0">
					<div class="panel panel-default tasklist" style="padding:20px">
						<?php $tables->getsubTaskList(); ?>
						<?php $tables->getInsertFunction("table_note"); ?>
					</div>
				</div>
				
				</div>
				</div>
				
				
</body>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
</html>
<?php include "kon/kon.php"; $tables=new Tables(); ?>
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel"><?php if($_POST['mode']==0)echo 'Start Project'; else echo 'Stop Project';?></h4>
		</div>
			<form id="project_start_form" name="form2" method="post">
			<div class="modal-body stinsert">
					<div id="panel">
						<div class="notifstart">
						
						</div>
						<div class="modal-body stinsert">
									<div class="form-group">
											<label>Select Date</label>
											<input name='subtask_start' id='subtask_start_pro' class='form-control subtask_start' placeholder='<?php if($_POST['mode']==0)echo 'Start Project In'; else echo 'Stop Project In';?>'>
									</div>
							
						</div>
					</div>
		</div>
		<div class="modal-footer">
			
			<button type="button" class="btn btn-primary" onclick="  <?php if($_POST['mode']==0)echo 'startproject'; else echo 'stopproject';?>  ('<?php echo $_POST['code'] ?>','<?php echo $_POST['task_code'] ?>')"><?php if($_POST['mode']==0)echo 'Start'; else echo 'Stop';?></button>
      <button type="reset" class="btn btn-default">Reset</button>
		</div>
		</form>
		<script>
			$(function() {
					$("#subtask_start_pro").datepicker({
							dateFormat : 'yy-mm-dd'
					});
			});
		</script>
<?php include "kon/kon.php"; $tables=new Tables(); ?>

		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">New Task</h4>
		</div>
			<form id="table_task_sub_form" name="form2" method="post" action="table_task_sub_insert.php">
			<div class="modal-body stinsert">
					<div id="panel">
						<div class="modal-body stinsert">
									<div class="form-group">
											<label>Task Code</label>
											<?php $tables->getComboBox("select * from table_task","task_code") ?>
											<label>Subtask Code</label>
											<input name='subtask_code' onclick='makeid()' id='subtask_code' class='form-control' placeholder='Enter Subtask Code'>
											<label>Subtask Name</label>
											<input name='subtask_name' id='subtask_name' class='form-control' placeholder='Enter Subtask Name'>
											<label>Subtask Desc</label>
											<textarea name='subtask_desc' id='subtask_desc' class='form-control' placeholder='Enter Subtask Desc'></textarea>
											
											
											<label>Subtask In</label>
											<input name='subtask_in' id='subtask_in' class='form-control' placeholder='Enter Subtask In'>
											<label>Subtask Target</label>
											<input name='subtask_target' id='subtask_target' class='form-control' placeholder='Enter Subtask Target'>
											<label>Subtask Start</label>
											<input name='subtask_start' id='subtask_start' class='form-control' placeholder='Enter Subtask Start'>
											<label>Subtask Out</label>
											<input name='subtask_out' id='subtask_out' class='form-control' placeholder='Enter Subtask Out'>
											<label>Subtask Color</label>
											<input name='subtask_color' id='subtask_color' class='form-control' placeholder='Enter Subtask Color'>
									</div>
							
						</div>
					</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-default">Reset</button>
		</div>
		</form>
		<script src="table_task_sub_insert.js" type="text/javascript"></script>
		<script>
			$(function() {
					$("#subtask_in").datepicker({
							dateFormat : 'yy-mm-dd'
					});
			});
			$(function() {
					$("#subtask_target").datepicker({
							dateFormat : 'yy-mm-dd'
					});
			});
			$(function() {
					$("#subtask_start").datepicker({
							dateFormat : 'yy-mm-dd'
					});
			});
			$(function() {
					$("#subtask_out").datepicker({
							dateFormat : 'yy-mm-dd'
					});
			});
		</script>
$(document).ready(function() {$('#table_task_sub_form').submit(function() {
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(data) {
					$('#notif').html(data);
					alert(data);
					//$('#tbltable_task_sub').load('table_task_sub_refresh.php');
					$('#table_task_sub_form').trigger('reset');
				}
			})
			return false;
		});
			});
			function edit(pk)
			{
				var id=pk;
				var subtask_name=$('#'+id+'subtask_name').val();var subtask_desc=$('#'+id+'subtask_desc').val();var task_code=$('#'+id+'task_code').val();var subtask_in=$('#'+id+'subtask_in').val();var subtask_target=$('#'+id+'subtask_target').val();var subtask_start=$('#'+id+'subtask_start').val();var subtask_out=$('#'+id+'subtask_out').val();var subtask_color=$('#'+id+'subtask_color').val();$.ajax(
				{
				  type: 'POST',
				  url: '#table_task_sub_update.php',
				  data: 
				  {subtask_code:id,subtask_name:subtask_name,subtask_desc:subtask_desc,task_code:task_code,subtask_in:subtask_in,subtask_target:subtask_target,subtask_start:subtask_start,subtask_out:subtask_out,subtask_color:subtask_color,},
				  success: function(data) {
					$('#notif').fadeIn('slow');
					alert(data);
					$('#tbltable_task_sub').load('table_task_sub_refresh.php');
					$('#table_task_sub').trigger('reset');
				  }
				})
				return false;
			}
			
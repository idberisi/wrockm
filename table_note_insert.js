$(document).ready(function() {$('#table_note_form').submit(function() {
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(data) {
					$('#notif').fadeIn('slow');
					$('#notif').html(data);
					$('#tbltable_note').load('table_note_refresh.php');
					$('#table_note').trigger('reset');
				}
			})
			return false;
		});
			});
			function edit(pk)
			{
				var id=pk;
				var subtask_id=$('#'+id+'subtask_id').val();var note=$('#'+id+'note').val();$.ajax(
				{
				  type: 'POST',
				  url: '#table_note_update.php',
				  data: 
				  {note_id:id,subtask_id:subtask_id,note:note},
				  success: function(data) {
					$('#notif').fadeIn('slow');
					alert(data);
					$('#tbltable_note').load('table_note_refresh.php');
					$('#table_note').trigger('reset');
				  }
				})
				return false;
			}
			
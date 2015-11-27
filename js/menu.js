$( document ).ready(function() {
		var a=0;
		var b=0;
		var d=parseFloat($("#chill").css("padding-right"));
		
		
		$("#taskAll").click(function(){
			$.ajax({
				type: 'POST',
				url: 'taskall.php',
				data:  {task:'all'},
				success: function(data) {
					$('.tengah').append("<div class='container-fluid'><div class='panel panel-default'>"+data+"</div></div>");
				}
			})
		});
		
		$("#taskPending").click(function(){
			$.ajax({
				type: 'POST',
				url: 'taskall.php',
				data:  {task:'pending'},
				success: function(data) {
					$('.tengah').append("<div class='container-fluid'><div class='panel panel-default'>"+data+"</div></div>");
				}
			})
		});
		
		$("#subtaskadd").click(function(){
			$( ".stinsert" ).empty();
			$('.stinsert').load('table_task_sub_form.php');
		});
		
		
});
	function bwr(fld,fldname)
	{
		$.ajax({
				type: 'POST',
				url: 'files_explorer.php',
				data:  {folder:fld,folder_name:fldname},
				success: function(data) {
					$( ".stinsert" ).empty();
					$('.stinsert').append(data);
				}
			})
	}
	
	function startpro(scode,taskcode)
	{
		$.ajax({
				type: 'POST',
				url: 'project_form.php',
				data:  {code:scode,task_code:taskcode,mode:'0'},
				success: function(data) {
					$( ".stinsert" ).empty();
					$('.stinsert').append(data);
				}
			})
	}
	
	function startproject(scode,taskcode)
	{
		
		var datex=$('#subtask_start_pro').val();
		$.ajax({
				type: 'POST',
				url: 'project_start.php',
				data:  {code:scode,task_code:taskcode,date:datex},
				success: function(data) {

					if(data=='1')
					{
						$('.notifstart').append('<div class="alert alert-success" role="alert">Project Started</div>');
						$('.tasklist').empty();
						$('.tasklist').load('refresh.php?mode=index&query=0');
					}
					else
					{
						var str = data;
						var res = str.split(",");
						$('.notifstart').append('<div class="alert alert-danger" role="alert">'+res[1]+'</div>')
					}
				}
			})
	}
	
	function stoppro(scode,taskcode)
	{
		$.ajax({
				type: 'POST',
				url: 'project_form.php',
				data:  {code:scode,task_code:taskcode,mode:'1'},
				success: function(data) {
					$( ".stinsert" ).empty();
					$('.stinsert').append(data);
				}
			})
	}
	
	function stopproject(scode,taskcode)
	{
		
		var datex=$('#subtask_start_pro').val();
		$.ajax({
				type: 'POST',
				url: 'project_stop.php',
				data:  {code:scode,task_code:taskcode,date:datex},
				success: function(data) {

					if(data=='1')
					{
						$('.notifstart').append('<div class="alert alert-success" role="alert">Project Stopped</div>');
						$('.tasklist').empty();
						$('.tasklist').load('refresh.php?mode=index&query=0');
					}
					else
					{
						var str = data;
						var res = str.split(",");
						$('.notifstart').append('<div class="alert alert-danger" role="alert">'+res[1]+'</div>')
					}
				}
			})
	}
	
	function makeid()
	{
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			for( var i=0; i < 5; i++ )
					text += possible.charAt(Math.floor(Math.random() * possible.length));
			$('#subtask_code').val(text);
			//return text;
	}
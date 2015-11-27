<?php 
	$folder=$_POST['folder'];
	$dh  = opendir($folder);
	while (false !== ($filename = readdir($dh))) {
    $files[] = $filename;
	}
	
	$folder_name=$_POST['folder_name']
	
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel"><?php echo $folder_name." Files" ?></h4>
	</div>
	<div class="modal-body stinsert">
	<?php
	for ($i=2;$i<count($files);$i++)
	{
		if($files[$i] !="." ||$files[$i] !="..")
		{
					//header('Content-disposition: inline');
					//header('Content-type: application/msword'); // not sure if this is the correct MIME type
					//readfile("$folder/$files[$i]");
					//exit;
					echo "<a href='$folder/$files[$i]'>$files[$i]</a>";
					echo "<br>";	
		}
	}
?>
</div>
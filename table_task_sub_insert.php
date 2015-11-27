<?php 
	include 'kon/kon.php';
	
	if (trim($_POST['subtask_code']) ==''){
		$error[]= '- subtask_code harus diisi';
	}

	
	if (trim($_POST['subtask_name']) ==''){
		$error[]= '- subtask_name harus diisi';
	}

	
	if (trim($_POST['subtask_desc']) ==''){
		$error[]= '- subtask_desc harus diisi';
	}

	
	if (trim($_POST['task_code']) ==''){
		$error[]= '- task_code harus diisi';
	}

	
	if (trim($_POST['subtask_in']) ==''){
		$error[]= '- subtask_in harus diisi';
	}

	
	if (trim($_POST['subtask_target']) ==''){
		$error[]= '- subtask_target harus diisi';
	}

	
	if (trim($_POST['subtask_start']) ==''){
		$error[]= '- subtask_start harus diisi';
	}

	
	if (trim($_POST['subtask_out']) ==''){
		$error[]= '- subtask_out harus diisi';
	}

	
	if (trim($_POST['subtask_color']) ==''){
		$error[]= '- subtask_color harus diisi';
	}

	$subtask_code=$_POST['subtask_code'];
	$subtask_name=$_POST['subtask_name'];
	$subtask_desc=nl2br($_POST['subtask_desc']);
	$task_code=$_POST['task_code'];
	$subtask_in=$_POST['subtask_in'];
	$subtask_target=$_POST['subtask_target'];
	$subtask_start=$_POST['subtask_start'];
	$subtask_out=$_POST['subtask_out'];
	$subtask_color=$_POST['subtask_color'];
	
	if (isset($error)){
		echo implode("<br />", $error);
	} else {
		try{
			$pdo = new PDOx();
			$dbh=$pdo->getKoneksi();
			$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql="INSERT INTO table_task_sub(subtask_code,subtask_name,subtask_desc,task_code,subtask_in,subtask_target,subtask_start,subtask_out,subtask_color)VALUES (:subtask_code,:subtask_name,:subtask_desc,:task_code,:subtask_in,:subtask_target,:subtask_start,:subtask_out,:subtask_color)";
			$q = $dbh->prepare($sql);
			$q->execute(array('subtask_code'=>$subtask_code,'subtask_name'=>$subtask_name,'subtask_desc'=>$subtask_desc,'task_code'=>$task_code,'subtask_in'=>$subtask_in,'subtask_target'=>$subtask_target,'subtask_start'=>$subtask_start,'subtask_out'=>$subtask_out,'subtask_color'=>$subtask_color));
			echo "Succes add data!";
		}

		catch(PDOException $e){
			echo "Error". $e->getMessage();
			exit;
		}

	}

	?>
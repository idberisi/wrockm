<?php 
	include 'kon/kon.php';
		try{
			$pdo = new PDOx();
			$dbh=$pdo->getKoneksi();
			$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql="UPDATE `table_task_sub` SET `subtask_out` = '".$_POST['date']."' WHERE `subtask_code` = '".$_POST['code']."' AND `task_code` = '".$_POST['task_code']."';";
			$q = $dbh->prepare($sql);
			$q->execute();
			echo "1";
		}

		catch(PDOException $e){
			echo "0,". $e->getMessage();
			exit;
		}
	?>
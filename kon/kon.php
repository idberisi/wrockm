<?php
	class PDOx{
		function getDatabase(){
			$database= 'data_wrockm';
			return $database;
		}
		function getKoneksi(){
			$hostname = '127.0.0.1';
			$username = 'root';
			$password = '';
			$database= 'data_wrockm';
			$koneksi = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
			return $koneksi;
		}
	}

	
	class Insert{
		function rating($id)//GET TABLE FROM DATABASE AKA STD
			{
			try {
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$preparedStatement->execute();
				$koneksi=null;
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}

		}

	}

	
	class Tables{
		function getTable($table_name)// GET TABLE FROM DATABASE AKA STD
			{
			try {
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$preparedStatement=$koneksi->prepare("SELECT column_name FROM information_schema.columns WHERE table_name='$table_name' and table_schema='$database'");
				$preparedStatement->execute();
				$baris=0;
				$headTbl=array();
				echo '<table id=tbl'.$table_name.' class="tbla"><tr>';
				$results=$preparedStatement->fetchAll();
				foreach($results as $result){
					array_push($headTbl,$result[0]);
					$isi=str_replace("_", " ", $result[0]);
					echo "<th>".ucwords($isi)."</th>";
					$baris+=1;
				}

				//echo "<th>Fungsi</th>";
				echo "</tr>";
				$preparedStatement=$koneksi->prepare("SELECT * from $table_name");
				$preparedStatement->execute();
				echo "<tr>";
				$results=$preparedStatement->fetchAll();
				foreach($results as $result){
					echo "<tr>";
					for ($a=0;$a<$baris;$a++){
						//echo "<td><input type='text' id='$result[0]$headTbl[$a]' name='$headTbl[$a]' value='".$result[$a]."'></td>";
						echo "<td>$result[$a]</td>";
					}

					//echo '<td align="center"><button onclick="hapus('."'".$result[0]."'".')">Hapus</button>';
					//echo '<button onclick="edit('."'".$result[0]."'".')">Edit</button></td>';
					echo "</tr>";
				}

				echo "</tr></table>";
				$koneksi=null;
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		
		function getTableAndroid($table_name)// GET TABLE FROM DATABASE AKA STD
			{
			try {
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$preparedStatement=$koneksi->prepare("SELECT * from $table_name");
				$preparedStatement->execute();
				while($r=mysql_fetch_array($preparedStatement)){
					$arr[] = $r;
				}

				echo '{"items":'. json_encode($arr).'}';
				$koneksi=null;
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}
			}

			
			function getScalar($query)
			{
				try {
					$pdo = new PDOx();
					$koneksi=$pdo->getKoneksi();
					$database=$pdo->getDatabase();
					$preparedStatement=$koneksi->prepare("$query");
					$preparedStatement->execute();
					$results=$preparedStatement->fetchAll();
					foreach($results as $result){
						echo $result[0];
					}
					$koneksi=null;
				}

				catch(PDOException $e){
					echo $e->getMessage();
				}	
			}
			
			function getsubTaskList()
			{
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$preparedStatement=$koneksi->prepare("SELECT * from table_project Order by project_priority ASC");
				$preparedStatement->execute();
				$results=$preparedStatement->fetchAll();
				foreach($results as $result0){
					//mkdir("files/$result0[0]");
					echo "<div class='panel'><li class='lrpoject'><span class='glyphicon glyphicon-folder-close' aria-hidden='true'></span> ".$result0[1]."</li></div>";
					$preparedStatement=$koneksi->prepare("SELECT * from table_version where project_code=$result0[0] ORDER BY version_desc DESC");
					$preparedStatement->execute();
					$results=$preparedStatement->fetchAll();
					echo "<ul>";
					foreach($results as $result1){
						//mkdir("files/$result0[0]/$result1[0]");
						echo "<div class='panel'><li class='lversion'><span class='glyphicon glyphicon-briefcase' aria-hidden='true'></span> ".$result1[2]."</li></div>";
						echo "<ul>";
						$preparedStatement=$koneksi->prepare("SELECT * from table_task where version_code='$result1[0]' order by task_desc desc");
						$preparedStatement->execute();
						$results=$preparedStatement->fetchAll();
						foreach($results as $result2){
								//mkdir("files/$result0[0]/$result1[0]/$result2[0]");
								echo "<div class='panel'><li class='ltask'><span class='glyphicon glyphicon-blackboard' aria-hidden='true'></span> ".$result2[1]."</li></div>";
								echo "<ul>";
								$preparedStatement=$koneksi->prepare("SELECT * from table_task_sub where task_code='$result2[0]' order by subtask_in desc");
								$preparedStatement->execute();
								$results2=$preparedStatement->fetchAll();
								foreach($results2 as $result3){
										//mkdir("files/$result0[0]/$result1[0]/$result2[0]/$result3[0]");
										$dir = "files/$result0[0]/$result1[0]/$result2[0]/$result3[0]";
										echo "<div class='panel' style='padding:0><li class='lsubtask'><div class='row'><div class='col-xs-12 col-md-8'><span class='glyphicon glyphicon-tasks' aria-hidden='true'></span> ".$result3[1];
										echo "</div>";
										echo '<div class="col-xs-6 col-md-4" style="font-size:12px"><center>';
										$date1=date_create($result3[4]);
										echo "<div class='col-xs-6 col-sm-3 timein'>".date_format($date1,"d M y")."</div>";
										$date2=date_create($result3[5]);
										echo "<div class='col-xs-6 col-sm-3 timetarget'>".date_format($date2,"d M y")."</div>";
										$date3=date_create($result3[6]);
										if($result3[6]!="0000-00-00")
										$datest=date_format($date3,"d M y");
										else
										$datest="-";
										echo "<div class='col-xs-6 col-sm-3 timestart'>".$datest."</div>";
										$date4=date_create($result3[7]);
										if($result3[7]!="0000-00-00")
										$dateout=date_format($date4,"d M y");
										else
										$dateout="-";
										echo "<div class='col-xs-6 col-sm-3 timeout'>".$dateout."</div>";
										echo "</div></center>";
										echo "</div><hr>";
										echo "</li>";
										echo "<ul class='isisubtask'>";
										echo "<li>".$result3[2]."</li>";
										echo '<li><a onclick="bwr('."'$dir'".','."'$result3[1]'".')" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span></a>';
										echo '<a onclick="startpro('."'$result3[0]'".','."'$result3[3]'".')" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>';	
										
										if($result3[6]=="0000-00-00")
										{
											echo '<a onclick="startpro('."'$result3[0]'".','."'$result3[3]'".')" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a>';	
										}
										else
										{
											if($result3[7]=="0000-00-00")
											{
												echo '<a onclick="stoppro('."'$result3[0]'".','."'$result3[3]'".')" data-toggle="modal" data-target="#myModal" ><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></a>';	
											}
										}
										
										
										
										// $diff1=date_diff($date1,$date2);
										// $smhr=$diff1->format('%a');//jumlah hari
										// if($smhr !=0)
										// {
											// $diff2=date_diff($date1,$date3);
											// $smhr2=$diff2->format('%a');//in ke start
											
											// $diff3=date_diff($date3,$date4);
											// $smhr3=$diff3->format('%a');//start ke out
											
											// $diff4=date_diff($date2,$date4);
											// $smhr4=$diff4->format('%a');//start ke out
											
											// if($smhr2<100 && $smhr2>1)
											// {
												// $start=($smhr2/$smhr)*100;
												
												// echo "<div class='panel'>";
												// echo "<div class='stp2' style='float:left;width:$start%;background:#2980B9;height:4px'></div>";
												
												// if($result3[7]!="0000-00-00")
												// {
													// $target=($smhr3/$smhr)*100;
													// $targetout=($smhr4/$smhr)*100;
													// echo "<div class='stp2' style='float:left;width:$target%;background:#E67E22;height:4px'></div>";
													// echo "<div class='stp2' style='float:left;width:$targetout%;background:#27AE60;height:4px'></div>";
												// }
												// else
												// {
													// $today=date_create(date("Y/m/d"));
													
													// $diff4=date_diff($date2,$today);
													// $smhr4=$diff4->format('%a');//hari ke target
													
													// $diff3=date_diff($today,$date3);
													// $smhr3=$diff3->format('%a');//hari ke target
													// $target=($smhr3/$smhr)*100;
													// $targetout=($smhr4/$smhr)*100;
													// echo $target;
													// echo "<div class='stp2' style='float:left;width:$target%;background:#E67E22;height:4px'></div>";
													// echo "<div class='stp2' style='float:left;width:$targetout%;background:#27AE60;height:4px'></div>";	
												// }
												// echo "<br>";
												// echo "<br>";
												// echo "</div>";
											// }
											
										// }
										
										echo "</li></ul>";
										
										echo "</div>";
										
								}
								echo "</ul>";
						}
						echo "</ul>";
					}
					echo "</ul>";
				}
			}
		
		function getTableCustomColumnHeader($table_name,$colnames,$wherecond,$limits,$orders,$arr_header){
			try {
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$baris=0;
				$limit="";
				$order="";
				if($limits !=null)
				{
					$limit="Limit $limits";
				}
				if($orders !=null)
				{
					$order="ORDER BY $orders DESC";
				}
				echo '<table id=tbl'.$table_name.' class="table"><tr>';
				$colname = explode(",", $colnames);
				if($arr_header == 1)
				{
					for ($i=0;$i<count($colname);$i++)
					{
						echo "<th>".$colname[$i]."</th>";
						
					}
				}
				//echo "<th>Fungsi</th>";
				echo "</tr>";
				if($wherecond ==null)
				{
					$preparedStatement=$koneksi->prepare("SELECT $colnames from $table_name $order $limit");
				}
				else if($wherecond =="CUSTOM")
				{
					$preparedStatement=$koneksi->prepare($table_name);
				}
				else
				{
					$preparedStatement=$koneksi->prepare("SELECT $colnames from $table_name where $wherecond $order $limit");
				}
				
				$preparedStatement->execute();
				echo "<tr>";
				$results=$preparedStatement->fetchAll();
				foreach($results as $result){
					echo "<tr>";
					
					for ($a=0;$a<count($colname);$a++){
						//echo "<td><input type='text' id='$result[0]$headTbl[$a]' name='$headTbl[$a]' value='".$result[$a]."'></td>";
						echo "<td class='$result[0]'>".mb_strimwidth($result[$a], 0, 200, '...')."</td>";
					}

					//echo '<td align="center"><button onclick="hapus('."'".$result[0]."'".')">Hapus</button><br> ';
					//echo '<button onclick="edit('."'".$result[0]."'".')">Edit</button></td>';
					echo "</tr>";
				}

				echo "</tr></table>";
				$koneksi=null;
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		
		function getFormInsert($table_name)// GET FORM INSERT INTO FILE AKA STD
			{
			try {
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$preparedStatement=$koneksi->prepare("SELECT column_name FROM information_schema.columns WHERE table_name='$table_name' and table_schema='$database'");
				$preparedStatement->execute();
				$baris=0;
				$isi="";
				$isi.='<head><script src="js/jquery-1.11.2.min.js"></script><script src="'.$table_name.'_insert.js" type="text/javascript"></script> </head>';
				$isi.='<body>';
				$isi.='<form id="'.$table_name.'_form" name="form2" method="post" action="'.$table_name.'_insert.php">';
				$isi.= '<div class="form-group">';
				$results=$preparedStatement->fetchAll();
				foreach($results as $result){
					$isid=str_replace("_", " ", $result[0]);
					$isi.= "<label>".ucwords($isid)."</label><input name='$result[0]' id='$result[0]' class='form-control' placeholder='Enter ".ucwords($isid)."'>";
					$baris+=1;
				}

				$isi.= "</div>";
				$isi.= '<button type="submit" class="btn btn-default">Submit</button>';
				$isi.= '<button type="reset" class="btn btn-default">Reset</button>';
				$isi.= '</from></body>';
				$myfile=fopen($table_name.'_form.php',"w");
				fwrite ($myfile,$isi);
				fclose($myfile);
				$koneksi=null;
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		
		function getInsertFunction($table_name){
			try {
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$preparedStatement=$koneksi->prepare("SELECT column_name FROM information_schema.columns WHERE table_name='$table_name' and table_schema='$database'");
				$preparedStatement->execute();
				$baris=0;
				$results=$preparedStatement->fetchAll();
				$scr="";
				$scr.="<?php include 'kon/kon.php';";
				foreach($results as $result){
					$scr.="if (trim(".'$_POST'."['".$result[0]."']) ==''){".'$error[]'."= '- $result[0] harus diisi';}";
				}

				foreach($results as $result){
					$scr.= '$'.$result[0].'=$_POST['."'".$result[0]."'".'];';
				}

				$scr.='if (isset($error)){echo implode("<br />", $error);}';
				$scr.='else{';
				$scr.= 'try{';
				$scr.= '$pdo = new PDOx();$dbh=$pdo->getKoneksi();$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );';
				$scr.= '$sql="INSERT INTO '.$table_name.'(';
				$lgr=0;
				foreach($results as $result){
					if($lgr==count($result))
					{
						$scr.= $result[0];
					}
					else
					{
						$scr.= $result[0].',';
					}
					$lgr+=1;
				}
				$scr.= ')';
				$lgr=0;
				$scr.= 'VALUES (';
				foreach($results as $result){
					if($lgr==count($result))
					{
						$scr.= ':'.$result[0];
					}
					else
					{
						$scr.= ':'.$result[0].',';
					}
					$lgr+=1;
				}
				$lgr=0;
				$scr.=')"; ';
				$scr.= '$q = $dbh->prepare($sql); ';
				$scr.='$q->execute(array(';
				foreach($results as $result){
					if($lgr==count($result))
					{
						$scr.= "'$result[0]'=>".'$'."$result[0]";
					}
					else
					{
						$scr.= "'$result[0]'=>".'$'."$result[0],";
					}
					$lgr+=1;
				}
				$scr.=")); ";
				$scr.='echo "Succes add data!";} ';
				$scr.= 'catch(PDOException $e){';
				$scr.= 'echo "Error". $e->getMessage(); ';
				$scr.= 'exit;}}?>';
				$myfile=fopen($table_name.'_insert.php',"w");
				fwrite ($myfile,$scr);
				fclose($myfile);
				$myfile2=fopen($table_name.'_insert.js',"w");
				$scr2="";
				$scr2.='$(document).ready(function() {';
				$scr2.="$('#$table_name".'_form'."').submit(function() {
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(data) {
					$('#notif').fadeIn('slow');
					$('#notif').html(data);
					$('#tbl$table_name').load('".$table_name."_refresh.php');
					$('#$table_name').trigger('reset');
				}
			})
			return false;
		});
			});
			function edit(pk)
			{
				var id=pk;
				";
				$apk=0;
				foreach($results as $result){
					$apk+=1;
					
					if ($apk==1){
					} else {
						$scr2.= "var $result[0]=$('#'+id+'$result[0]').val();";
					}

				}

				$scr2.="$.ajax(
				{
				  type: 'POST',
				  url: '#".$table_name."_update.php',
				  data: 
				  {";
				$apk=0;
				foreach($results as $result){
					$apk+=1;
					
					if ($apk==1){
						$scr2.="$result[0]:id,";
					} else {
						$scr2.= "$result[0]:$result[0],";
					}

				}

				$scr2.="},
				  success: function(data) {
					$('#notif').fadeIn('slow');
					alert(data);
					$('#tbl$table_name').load('".$table_name."_refresh.php');
					$('#$table_name').trigger('reset');
				  }
				})
				return false;
			}
			";
				fwrite ($myfile2,$scr2);
				fclose($myfile2);
				$koneksi=null;
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		
		function getTableCustomHeader($table_name,$arr_header){
			try {
				$pdo = new PDOx();
				$koneksi=$pdo->getKoneksi();
				$database=$pdo->getDatabase();
				$baris=0;
				echo '<table class="table"><tr>';
				foreach($arr_header as $result){
					echo "<td>".$result."</td>";
					$baris+=1;
				}

				echo "</tr>";
				$preparedStatement=$koneksi->prepare("SELECT * from $table_name");
				$preparedStatement->execute();
				echo "<tr>";
				$results=$preparedStatement->fetchAll();
				foreach($results as $result){
					echo "<tr>";
					for ($a=0;$a<$baris;$a++){
						echo "<td>".$result[$a]."</td>";
					}

					//echo "<td><a href='edit.php'>Edit</a></td>";
					echo "</tr>";
				}

				echo "</tr></table>";
				$koneksi=null;
			}

			catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		
		function login($username,$password){
			$pdo = new PDOx();
			$dbh=$pdo->getKoneksi();
			$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			//echo "SELECT $slc FROM $tbl_nm";
			try {
				$result= $dbh->query("SELECT * FROM tbl_user WHERE user_id='$username' && user_password='$password'");
				$cek_user=$result->rowCount();
				$username="";
				$userid="";
				$level="";
				$lokasi="";
				while($row = $result->fetch()) {
					$username=$row[0];
					$userid=$row[1];
					$level=$row[4];
					$lokasi=$row[2];
				}

				return array($username, $userid, $level,$lokasi,$cek_user);
				$dbh = null;
			}

			catch (PDOException $e) {
				// tampilkan pesan kesalahan jika koneksi gagal
				print "Koneksi atau query bermasalah: " . $e->getMessage() . "<br/>";
				die();
			}

		}

		
		function getComboBox($query,$name){
			$pdo = new PDOx();
			$dbh = $pdo->getKoneksi();
			$database=$pdo->getDatabase();
			$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			try {
				echo "        
			<select id='$name' name='$name' class='form-control'>";
				$result = $dbh->query("$query");
				while($row = $result->fetch()) {
					echo "<option value='$row[0]'>$row[1]</option>";
				}

				echo"</select>							    
			";
				// hapus koneksi
				$dbh = null;
			}

			catch (PDOException $e) {
				// tampilkan pesan kesalahan jika koneksi gagal
				print "Gagal ! " . $e->getMessage() . "<br/>";
				die();
			}

		}

		
		function getMenu($level,$name){
			echo"<div class='tblsam'>";
			echo"<div id='IDen'><center><div id='waktu'>WW</div><img src='img/avatar.jpg'><h2 id='uid'>$name</h2><a href='login.php'>Logout</a></center></div>";
			echo"</div>";
			
			if ($level==1){
				echo"<div class='tblsam'>";
				echo"<ul id='ul1'>User</ul>";
				echo"<div id='li1'>";
				echo"<li><a href='user.php'>Daftar User</a></li>";
				echo"<li><a href='userTambah.php'>Tambah User</a></li>";
				echo"</div>";
				echo"<ul id='ul2'>Cabang</ul>";
				echo"<div id='li2'>";
				echo"<li><a href='cabang.php'>Daftar Cabang</a></li>";
				echo"<li><a href='cabangTambah.php'>Tambah Cabang</a></li>";
				echo"</div>";
				echo"<ul id='ul3'>Transaksi</ul>";
				echo"<div id='li3'>";
				echo"<li><a href='transaksicabangs.php'>Transakasi Cabang</a></li>";
				echo"</div>";
				echo"</div>";
			} 
			else if($level==2){
							echo"<div class='tblsam'>";
			echo"<ul id='ul1'>User</ul>";
			echo"<div id='li1'>";
				echo"<li><a href='user.php'>Daftar User</a></li>";
				echo"<li><a href='userTambah.php'>Tambah User</a></li>";
			echo"</div>";
			
			echo"<ul id='ul2'>Jenis Barang</ul>";
			echo"<div id='li2'>";
				echo"<li><a href='jenisbarang.php'>Daftar Jenis Barang</a></li>";
				echo"<li><a href='jenisbarangTambah.php'>Tambah Jenis Barang</a></li>";
			echo"</div>";
			
			echo"<ul id='ul3'>Barang</ul>";
			echo"<div id='li3'>";
				echo"<li><a href='barang.php'>Daftar Barang</a></li>";
				echo"<li><a href='barangTambah.php'>Tambah Barang</a></li>";
				
			echo"</div>";
			
			
			echo"<ul id='ul4'>Transaksi Barang</ul>";
			echo"<div id='li4'>";
				echo"<li><a href='stock.php'>Stock Barang</a></li>";
				echo"<li><a href='transaksi.php'>Transaksi Barang</a></li>";
			echo"</div>";
			
			echo"<ul id='ul5'>Order</ul>";
			echo"<div id='li5'>";
				echo"<li><a href='request_order.php'>Request Order</a></li>";
				echo"<li><a href='status_order.php'>Status Order</a></li>";
			echo"</div>";
			
			echo"<ul id='ul5'>Report</ul>";
			echo"<div id='li5'>";
				echo"<li><a href='list_report.php'>List Report</a></li>";
			echo"</div>";
			
			echo"</div>";	
			} 
			else if($level==3){
				echo"<div class='tblsam'>";
				echo"<ul id='ul1'>Order</ul>";
				echo"<div id='li1'>";
				echo"<li><a href='order_barang.php'>Request Order</a></li>";
				echo"<li><a href='status_order.php'>Status Order</a></li>";
				echo"</div>";
				echo"</div>";
			}

		}

		
		function getFooter(){
			echo"2015";
		}

		
	}

	

	?>
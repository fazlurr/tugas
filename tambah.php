<?php
	include 'cek-akses.php';
	if($_POST){		
		$filename = $_FILES['foto']['tmp_name'];
		$file_name = $_FILES['foto']['name'];

		//Extensi yang boleh
		$allowedExts = array("gif", "jpeg", "jpg", "png");

		//Extensionnya
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		
		//Generate Random Number
		$random_number = rand(00000,99999);
		
		//Lokasi penyimpanan gambar
		$dir = "img";
		$target = $dir . DIRECTORY_SEPARATOR . $_FILES['foto']['name'];	
		
		//Kalau nama file sudah ada
		if(file_exists($target)){
			$newfilename = $random_number . "." . $ext;
			$finaltarget = $dir . DIRECTORY_SEPARATOR . $newfilename;
			$foto2 = $newfilename;
		}
		//Kalau nama file belum ada
		else {
			$finaltarget = $target;
			$foto2 = $_FILES['foto']['name'];
		}
		
		//Jika Extensionnya diterima
		if(in_array($ext, $allowedExts)){
			//Upload Image
			if(move_uploaded_file($filename, $finaltarget)){
				//echo "The file ". basename( $_FILES['foto']['name']). " has been uploaded";
			}
			else {
				echo "Sorry, there was a problem uploading your file.";
			}
			
			$data = file_get_contents($dir . DIRECTORY_SEPARATOR . $_FILES['foto']['name']) or die(mysql_error());
			$data = mysql_real_escape_string($data);

			$nama = $_POST['nama'];
			$dob = $_POST['dob'];
			$tl = $_POST['tl'];
			$jk = $_POST['jk'];
			$tinggi = $_POST['tinggi'];

			//Connect DB
			$id = mysql_connect("localhost","root","") or die(mysql_error());
			if($id){
				mysql_select_db("artis");
				$query = "INSERT INTO biodata (`nama`, `foto`, `foto2`, `dob`, `tl`, `jk`, `tinggi`) 
	            	VALUES ('$nama','$data', '$foto2', '$dob','$tl','$jk','$tinggi')";
	            $hasil = mysql_query($query) or die(mysql_error());
	            //header('Location: index.php');
	    	}
		}
		else {
			$error = 1;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	    <title>Data Artis</title>
	   	<meta name="description" content="Tugas PBW">
	    <meta name="author" content="Fazlur Rahman">

	    <!-- Le styles -->
	    <link href="css/bootstrap.css" rel="stylesheet">
	    <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css">
	    <link href="css/custom.css" rel="stylesheet">
	</head>
	<div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="navbar-inner">
	      	<div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		        <a class="brand" href="index.php">Data Artis</a>
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li><a href="index.php">Home</a></li>
		            <li class="active"><a href="tambah.php"><i class='icon-white icon-plus'></i> Tambah Data</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="cari.php">
		            <input type="text" class="search-query span2" name="cari" placeholder="Search">
		          </form>
		          <ul class="nav pull-right">
			          	<li><a href="logout.php"><i class='icon-white icon-off'></i> Logout</a></li>
			      </ul>
		        </div><!-- /.nav-collapse -->
	      	</div>
	    </div><!-- /navbar-inner -->
  	</div><br><br>
  	<body>
		<div class="container">
			<form name="insert" method="POST" action="" enctype="multipart/form-data">
				<table class="table table-striped">
					<tr><td>Nama: <td><input type="text" name="nama" required></tr>
					<tr><td>Foto: <td><input type="file" name="foto" required></tr>
					<tr><td>Tanggal Lahir: <td><input type="date" name="dob" required></tr>
					<tr><td>Tempat Kelahiran: <td><input type="text" name="tl" required></tr>
					<tr>
						<td>Jenis kelamin: 
						<td>
							<select name="jk">
		                    	<option value="l">Laki-Laki</option>
		                    	<option value="p">Perempuan</option>
	                  		</select>
	                </tr>
					<tr>
						<td>Tinggi: <td><input type="number" step="0.01" name="tinggi" required> M</tr>
					<tr>
						<td>
							<button class="button" type="submit">Submit</button><td></tr>
				</table>
			</form>
			<?php
				if(isset($error) && $error == 1){
					echo "<div class=\"alert alert-error\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<h4>Tipe file foto tidak sesuai!</h4>
						Tipe file foto harus berupa .jpg, .jpeg, .png, atau .gif
						</div>";
				}
			?>
		</div>
		<!-- Javascript -->
		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
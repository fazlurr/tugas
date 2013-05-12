<?php
	include 'cek-akses.php';
	if(!isset($_GET['id'])){
		header('Location: index.php');
	}
	$id_artis=$_GET['id'];

	$id=mysql_connect("localhost","root","");
	if($id) {
		// pilih database
		mysql_select_db("artis");
		// kirim peritah SQL
		$sql = "SELECT * From biodata Where id_artis = '$id_artis'";
		$hasil = mysql_query($sql, $id);
		$row=mysql_fetch_assoc($hasil);
	}

	if($_POST) {
		include_once("ubah.php");
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
		            <li><a href="tambah.php"><i class='icon-white icon-plus'></i> Tambah Data</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="search.php">
		            <input type="text" class="search-query span2" name="cari" placeholder="Search">
		          </form>
		          <ul class="nav pull-right">
			          	<li><a href="logout.php"><i class='icon-white icon-off'></i> Logout</a></li>
			          </ul>
		        </div><!-- /.nav-collapse -->
	      	</div>
	    </div><!-- /navbar-inner -->
  	</div><br><br>
	<div class="container">
		<form name="edit" action="" method="POST" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td>Foto:
					<?php 
						$image_content = $row['foto'];
						echo '<td><img class="image-wrap" src="data:image/png;base64,' . base64_encode($image_content) . '" />';?>
					<br><input type="file" enctype="multipart/form-data" name="foto" id="foto" title="foto"></tr>
				<tr>
					<td>Nama: <td><input type="text" name="nama" value="<?php echo $row['nama'] ?>" required></tr>
				<tr>
					<td>Tanggal Lahir: <td><input type="date" name="dob" value="<?php echo $row['dob'] ?>" required></tr>
				<tr>
					<td>Tempat Kelahiran: <td><input type="text" name="tl" value="<?php echo $row['tl'] ?>" required></tr>
				<tr>
					<td>Jenis kelamin: 
					<td>
						<select name="jk">
	                    	<option value="l" 
	                    		<?php if ($row['jk']=="l"){ echo 'selected = "selected"'; }?>>Laki-Laki</option>
	                    	<option value="p"
	                    		<?php if ($row['jk']=="p"){ echo 'selected = "selected"'; }?>>Perempuan</option>
                  		</select>
                </tr>
				<tr>
					<td>Tinggi: <td><input type="number" step="0.01" name="tinggi" value="<?php echo $row['tinggi'] ?>" required> M</tr>
				<tr>
					<td colspan=2>
						<input type="hidden" name="id_artis" value="<?php echo $row['id_artis'] ?>">
						<input class="button btn" type="submit"></tr>
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
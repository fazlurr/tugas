<?php
	include 'cek-akses.php';
	if($_FILES['foto']['name']){
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
		if (file_exists($target)){
			$newfilename = $random_number . "." . $ext;
			$finaltarget = $dir . DIRECTORY_SEPARATOR . $newfilename;
			$foto2 = $newfilename;
		}
		//Kalau nama file belum ada
		else {
			$finaltarget = $target;
			$foto2 = $_FILES['foto']['name'];
		}
		
		if(in_array($ext, $allowedExts)){
			//Upload Image
			if(move_uploaded_file($filename, $finaltarget)){
				echo "The file ". basename( $_FILES['foto']['name']). " has been uploaded";
			}
			else {
				echo "Sorry, there was a problem uploading your file.";
			}
			
			$data = file_get_contents($dir . DIRECTORY_SEPARATOR . $_FILES['foto']['name']) or die(mysql_error());
			$data = mysql_real_escape_string($data);

	 		$trigger = 0;
	 	}
	 	else {
	 		$error = 1;
	 	}
	}
	else {
		$trigger = 1;
	}
	
	$nama = $_POST['nama'];
	$dob = $_POST['dob'];
	$tl = $_POST['tl'];
	$jk = $_POST['jk'];
	$tinggi = $_POST['tinggi'];

	$id=mysql_connect("localhost","root","");
	if($id){
		mysql_select_db("artis");
	}

	if(isset($trigger)){
		if ($trigger == 0){
			$query = "UPDATE biodata SET `nama`='$nama', `foto`='$data', `foto2`='$foto2', `dob`='$dob', `tl`='$tl', `jk`='$jk', `tinggi`=$tinggi WHERE `id_artis`= '$id_artis' ";
		}
		else if ($trigger == 1){
			$query = "UPDATE biodata SET `nama`='$nama', `dob`='$dob', `tl`='$tl', `jk`='$jk', `tinggi`=$tinggi WHERE `id_artis`= '$id_artis' ";
		}

		$hasil = mysql_query($query) or die(mysql_error());
	    mysql_close($id);
	    if(!isset($error)){
	    	header('Location: index.php');
	    }
	}
	
?>
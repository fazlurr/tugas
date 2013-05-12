<?php
	include 'cek-akses.php';
	$nama = $_POST['nama'];
	$dob = $_POST['dob'];
	$tl = $_POST['tl'];
	$jk = $_POST['jk'];
	$tinggi = $_POST['tinggi'];
	$data = file_get_contents($_FILES['foto']['name']);
	$data = mysql_real_escape_string($data);
	
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$explode = explode(".", $_FILES["foto"]["name"]);
	$extension = end($explode);
	if ((($_FILES["foto"]["type"] == "image/gif")
	|| ($_FILES["foto"]["type"] == "image/jpeg")
	|| ($_FILES["foto"]["type"] == "image/jpg")
	|| ($_FILES["foto"]["type"] == "image/pjpeg")
	|| ($_FILES["foto"]["type"] == "image/x-png")
	|| ($_FILES["foto"]["type"] == "image/png"))
	&& ($_FILES["foto"]["size"] < 20000)
	&& in_array($extension, $allowedExts)) {
		if ($_FILES["foto"]["error"] > 0) {
	    	echo "Return Code: " . $_FILES["foto"]["error"] . "<br>";
	 	}
	  	else {
		    echo "Upload: " . $_FILES["foto"]["name"] . "<br>";
		    echo "Type: " . $_FILES["foto"]["type"] . "<br>";
		    echo "Size: " . ($_FILES["foto"]["size"] / 1024) . " kB<br>";
		    echo "Temp foto: " . $_FILES["foto"]["tmp_name"] . "<br>";

		    if (file_exists("img/" . $_FILES["foto"]["name"])) {
		    	echo $_FILES["foto"]["name"] . " already exists. ";
		    }
		    else {
		    	move_uploaded_file($_FILES["foto"]["tmp_name"],
		    	"img/" . $_FILES["foto"]["name"]);
		    	echo "Stored in: " . "img/" . $_FILES["foto"]["name"];
			}
		}
	}

	$id = mysql_connect("localhost","root","") or die(mysql_error());
	if($id){
		mysql_select_db("artis");
		$query = "INSERT INTO biodata (`nama`, `foto`, `dob`, `tl`, `jk`, `tinggi`) 
        	VALUES ('$nama','$data','$dob','$tl','$jk','$tinggi')";
        $hasil = mysql_query($query) or die(mysql_error());
        mysql_close($id);
        //header('Location: index.php');
	}
?>
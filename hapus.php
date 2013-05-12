<?php
	include 'cek-akses.php';
	$id_artis=$_GET['id'];
	// hapus dari database
	$id = mysql_connect("localhost","root","");
	if($id)
	{
		// pilih database
		mysql_select_db("artis");
		$query_file = "Select foto2 from biodata where id_artis='$id_artis'";
		$hasil_query = mysql_query($query_file, $id);
		$data = mysql_fetch_assoc($hasil_query);
		$filename = $data['foto2'];
		unlink('img/$filename');
		// kirim peritah SQL
		$sql = "delete from biodata where id_artis='$id_artis'";
		$hasil = mysql_query($sql, $id);
		
		// tutup koneksi
		mysql_close($id);
	}
	header("Location: index.php");
?>
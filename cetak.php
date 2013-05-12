<?php
	include 'cek-akses.php';
	if(!isset($_GET['id'])){
		header('Location: index.php');
	}
	// definisi dari class 
	require('fpdf/fpdf.php');
	$start=0;

	$id_artis=$_GET['id'];
	
	$xpdf = new FPDF();
	$xpdf->AddPage();
	$xpdf->SetFont('Arial','B',16);
	$xpdf->SetFillColor(55,174,200);
	$xpdf->Cell(190,10,'Hal:'.($xpdf->PageNo()+$start),0,1,'R',0);
	
	$id = mysql_connect("localhost","root","");
		if($id){
			mysql_select_db("artis");
			$sql = "select * from biodata where id_artis='$id_artis'";
			$hasil = mysql_query($sql);
			$row = mysql_fetch_assoc($hasil) or die(mysql_error());
			$idnya = $row['id_artis'];
			$nama = $row['nama'];
			$foto2 = $row['foto2'];
			$dob = $row['dob'];
			$tl = $row['tl'];
			$jk = $row['jk'];
			if ($jk == "l"){
				$jk2 = "Laki-Laki";
			}
			else {
				$jk2 = "Perempuan";
			}
			$tinggi = $row['tinggi'];
			//PDF nya
			$xpdf->Image("img/$foto2", 10, 10);
			$xpdf->Ln();
			$xpdf->Ln();
			$xpdf->Ln();
			$xpdf->Ln();
			$xpdf->Cell(50,10,'Nama :',1,0);
			$xpdf->Cell(140,10,$nama,1,1);
			$xpdf->Cell(50,10,'Tgl Lahir :',1,0);
			$xpdf->Cell(140,10,$dob,1,1);
			$xpdf->Cell(50,10,'Tempat Kelahiran:',1,0);
			$xpdf->Cell(140,10,$tl,1,1);
			$xpdf->Cell(50,10,'Jenis Kelamin :',1,0);
			$xpdf->Cell(140,10,$jk2,1,1);
			$xpdf->Cell(50,10,'Tinggi :',1,0);
			$xpdf->Cell(140,10,$tinggi,1,1);
			//mysql_close($id);
		}
	$xpdf->Output();
?>
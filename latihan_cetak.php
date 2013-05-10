<?php
// definisi dari class 
require('/fpdf/fpdf.php');
$start=0;
// membuat object atau instance
$xpdf=new FPDF();
// membuat halaman kosong dengan margin tertentu
// default menggunakan A4
$xpdf->AddPage();
// memilih huruf
$xpdf->SetFont('Arial','B',16);
// membuat cetakan berupa (textbox)
// width=40, height=10
$xpdf->SetFillColor(55,174,200);
$xpdf->Cell(190,10,'Hal:'.($xpdf->PageNo()+$start),0,1,'R',0);
$xpdf->Cell(80,10,'Baris pertama',1,1,'C',1);
$xpdf->Cell(80,10,'',1,1,'C');
$xpdf->Cell(40,10,'Baris kedua',1,1);
$xpdf->Cell(40,10,'2.500',1,1,'R');
$xpdf->MultiCell(100,6,'',1,1,'L');
/* tambahin garis
$xpdf->Line(10,10,190,270);
sisipin gambar
$xpdf->Image("logo.png", 0, 100);*/
$xpdf->AddPage();
$xpdf->Cell(190,10,'Hal:'.($xpdf->PageNo()+$start),0,1,'R',0);
$xpdf->Cell(80,10,'Ini cerita lain lagi',1,1,'C',1);
$id=mysql_connect("localhost","root","");
	if($id)
	{
		// pilih database
		mysql_select_db("artis");
		// kirim peritah SQL
		$sql="select * from biodata";
		$hasil=mysql_query($sql, $id);
		// ambil hasilnya
		while($record=mysql_fetch_array($hasil))
		{
			$nim = $record['id_artis'];
			$nama = $record['nama'];
			$xpdf->Cell(40,10, $nim,1,0);
			$xpdf->Cell(60,10, $nama,1,1);
		}
		// tutup koneksi
		mysql_close($id);
	}
// konversi menjadi file pdf
$xpdf->Output();
?>
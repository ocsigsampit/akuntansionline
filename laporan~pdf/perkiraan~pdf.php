<?php session_start();


if (session_is_registered('id_admin'))
{
	
	include "../include/conn.php";
	$koneksi=open_connection();
	//untuk core PDF
	require('fpdf.php');
	
	class PDF extends FPDF
	{
		function Header()
		{
			//Select Arial bold 15
			$this->SetFont('Arial','B',15);
			//Move to the right
			$this->Cell(80);
			//Framed title
			
			$judul='Chart Of Account';
			
			$this->Cell(50,10,$judul,0,0,'C');
			//Line break
			$this->Ln(20);
			
		}


		//Colored table
		function tabel_ri32_color()
		{
			//Queri untuk Menampilkan data
			$query ="SELECT * FROM tabel_master order by kode_rekening asc";
			$db_query = mysql_query($query) or die("Query gagal");

			//Column titles
			$header=array('Rekening','Nama','Posisi','Normal');
			
			//Colors, line width and bold font
			$this->SetFillColor(255,0,0);
			$this->SetTextColor(255);
			$this->SetDrawColor(128,0,0);
			$this->SetLineWidth(.3);
			$this->SetFont('','B');
			
			//Title table
			//$this->Cell(20,30,'Title',1,0,'C');
			
			//Header
			$w=array(35,90,30,30);
			for($i=0;$i<count($header);$i++)
				$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
			
			//Color and font restoration
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
			
			//Data
			$fill=false;
			
			//$this->Cell(-10,-20,'Enjoy new fonts with FPDF!');
			
			while($data=mysql_fetch_array($db_query))
			{
				$this->Cell($w[0],7,$data['kode_rekening'],'LR',0,'C',$fill);
				$this->Cell($w[1],7,$data['nama_rekening'],'LR',0,'L',$fill);
				$this->Cell($w[2],7,$data['posisi'],'LR',0,'C',$fill);
				$this->Cell($w[3],7,$data['normal'],'LR',0,'C',$fill);
				$this->Ln();
				$fill=!$fill;
			}
			
			$this->Cell(array_sum($w),10,'Copyright (c) 2010 E-Accounting','T');
		}
	}
	
	$pdf=new PDF();
	$title='Nomor Perkiraan';
	$pdf->SetTitle($title);
	$pdf->SetAuthor('Agus Sumarna');
	
	$pdf->SetFont('Arial','',12);
	$pdf->AddPage();
	//memanggil fungsi table
	$pdf->tabel_ri32_color();
	$pdf->Output();

}else{
	echo "Forbidden Access!";
}
?>

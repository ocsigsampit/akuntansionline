<?php 

if (isset($_SESSION['id_admin']))
{
?>	

	<?php
	if(isset($_POST['hitung_shu'])){
	
		///////////////////////// HITUNG SHU /////////////////////
		$master=mysql_query("select * from tabel_master");
		while($row=mysql_fetch_array($master)){
			$posisi=$row['posisi'];
			$sisa_debet=$row['sisa_debet'];
			$sisa_kredit=$row['sisa_kredit'];
			$kode_rekening=$row['kode_rekening'];
			
			if($posisi=='rugi-laba'){
				//update rugi laba
				$update=mysql_query("update tabel_master set rl_debet='$sisa_debet', rl_kredit='$sisa_kredit' where kode_rekening='$kode_rekening'");
			}else{
				//update neraca
				$update=mysql_query("update tabel_master set nrc_debet='$sisa_debet', nrc_kredit='$sisa_kredit' where kode_rekening='$kode_rekening'");
			}
		}
		
		
		//jika sudah selesai update
		if($update){
			$biaya=mysql_fetch_array(mysql_query("select sum(rl_debet) as biaya from tabel_master where normal='debet' and posisi='rugi-laba' and kode_rekening<>'314.01'"));
			$pendapatan=mysql_fetch_array(mysql_query("select sum(rl_kredit) as pendapatan from tabel_master where normal='kredit' and posisi='rugi-laba'"));
			
			//hitung SHU
			$shu=$pendapatan['pendapatan']-$biaya['biaya'];
		}
		

		//update rugi laba debet dan neraca kredit dengan SHU
		$update_shu=mysql_query("update tabel_master set rl_debet='$shu', nrc_kredit='$shu' where kode_rekening='314.01'");
		
		if($update_shu){
			$berhasil="Neraca dan Rugi Laba Berhasil dihitung";		
		}else{
			echo mysql_error();
		}
		
		
		///////////////////HITUNG LABA-RUGI////////////////////
		//hapus table semporial yang lama
		$hapus_tabel_temporial=mysql_query("delete from tabel_rugi_laba");
		if($hapus_tabel_temporial){
			//1. Tahap Penginputan
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening) values('I.','SUMBER PENGHASILAN')");
			mysql_query("INSERT INTO tabel_rugi_laba SELECT * FROM tabel_master where tabel_master.kode_rekening between '411.01' and '414.01'");
			
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening) values('II.','BIAYA UMUM DAN ADMINISTRASI')");
			
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening) values('A''BIAYA UMUM')");
			mysql_query("INSERT INTO tabel_rugi_laba SELECT * FROM tabel_master where tabel_master.kode_rekening between '511.02' and '521.99'");
			
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening) values('B','BIAYA ADMINISTRASI')");
			mysql_query("INSERT INTO tabel_rugi_laba SELECT * FROM tabel_master where tabel_master.kode_rekening between '522.01' and '522.99'");
			mysql_query("INSERT INTO tabel_rugi_laba SELECT * FROM tabel_master where tabel_master.kode_rekening between '711.01' and '811.99'");
			
			//2. Tahap Perhitungan
			$query_jumlah=mysql_fetch_array(mysql_query("select sum(rl_debet) as debet_rl, sum(rl_kredit) as kredit_rl from tabel_rugi_laba"));
			$debet_rl=$query_jumlah['debet_rl'];
			$kredit_rl=$query_jumlah['kredit_rl'];
			
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening, rl_kredit) values('III','JUMLAH PENDAPATAN', '$kredit_rl')");
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening, rl_debet) values('IV','JUMLAH BIAYA','$debet_rl')");
			
			$pendapatan=$kredit_rl;
			$biaya=$debet_rl;
			
			//ini untuk apa ya? :D
			//$rugi_laba=mysql_query("select sum(rl_debet) from tabel_master where kode_rekening between '314.01' and '314.09'");
			
			//3. Tahap Hitung SHU Tahun BErjalan
			$hitung_rl_debet=$kredit_rl-$debet_rl;
			$sisa_hasil_usaha=$hitung_rl_debet;
			
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening, rl_debet) values('V','Sisa Hasil Usaha Tahun Berjalan','$hitung_rl_debet')");
			
			$hitung_rl_biaya_shu=$biaya+$sisa_hasil_usaha;
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening,rl_debet,rl_kredit) values('VI','Total Balance', '$hitung_rl_biaya_shu','$pendapatan')");
			
			//4. Simpan tanggal periode
			mysql_query("INSERT INTO tabel_rugi_laba(kode_rekening, nama_rekening, tanggal_awal) values('VII','TANGGAL PERIODE', '$tanggal')");

		}else{
			echo mysql_error();
		}
							
	}else{
		unset($_POST['hitung_shu']);
	}
	?>
	
	<style type="text/css">
	<!--
	.style1 {font-style: italic}
	-->
	</style>

	<div class="post">
	  <div class="entry">
			<h2 align="center"><strong>Hitung SHU</strong></h2>
			<p align="center">&nbsp;</p>
			<p align="center">
			<p align="center" class="style1"><font color="#666666">
		    Proses ini adalah proses untuk menghasilkan laporan keuangan yaitu menghitung Rugi Laba. </font></p>
			<p align="center"><em><font color="#666666">Proses bisa dilakukan setelah semua data diposting.
		    <?php 
			$cek=mysql_query("select * from tabel_transaksi where keterangan_posting=''");
			$cek_posting=mysql_num_rows($cek);
			if($cek_posting!==0){
				//echo "masih ada yang belum di posting";
			}else{
				?>
				</font></em></p>
				<form action="?page=./laporan/hitung_shu" method="post" name="postform">
				<div align="center">
				<p>&nbsp;</p><p>
				<font color="#666666">
				<input type="submit" onclick="return confirm('Apakah Anda Yakin?')" name="hitung_shu" value="Proses Hitung SHU" />
				</font></p>
				</div>
				</form>
				<font color="#666666">
				<div align="center">
				<?php
			}
			?>
		    </div>
			</font>
		    <div align="center"><font color="#0066FF">
            <?php if(isset($berhasil)){echo  $berhasil;}?>		  
	        </font>
	        </p>
            </div>
	  </div>
	</div>
<?php 


}else{
	echo "Forbidden Access!";
}
?>


<?php 
if (isset($_SESSION['id_admin']))
{
?>	
	<div class="post">
		<div class="entry">
			<h2 align = "center"><strong>Posting</strong></h2>
			<p align = "center">&nbsp;</p>
			<p>
				<table class="datatable" border="1">
				<tr>
					<th>Tanggal</th>
					<th>Kode Rekening</th>
					<th>Keterangan</th>
					<th>Debet</th>
					<th>Kredit</th>
					<th>Keterangan</th>
				</tr>
				<?php
					$query_transaksi = mysql_query("SELECT * FROM tabel_transaksi ORDER BY tanggal_transaksi ASC");
					while($row_tran = mysql_fetch_array($query_transaksi)){
						$debet  = $row_tran['debet'];
						$kredit = $row_tran['kredit'];
					
				?>
						<tr>
							<td>
								<div align="center"><?php echo $row_tran['tanggal_transaksi'];?></div>
							</td>
							<td>
								<div align="center"><?php echo $row_tran['kode_rekening'];?></div>
							</td>
							<td><?php echo $row_tran['keterangan_transaksi'];?></td>
							<td align = "right"><?php echo number_format($debet,2,'.',','); ?></td>
							<td align = "right"><?php echo number_format($kredit,2,'.',','); ?></td>
							<td align = "center"><?php echo $row_tran['keterangan_posting'];?></td>
						</tr>
					<?php
					}
					?>
				</table>
			</p>
		</div>
	</div>

	<div class = "post">
		<div class = "entry">
			<p>
				<table border = "0" align="center">
					<tr>
						<td width = "72" align="center">
						<!---untuk mengakhiri posting dan memberi tanda posting-->
						<?php
						//Cari transaksi yang belum berstatus 'Posting"
						$cek = mysql_query("SELECT * FROM tabel_transaksi WHERE keterangan_posting =''");
						$cek_posting = mysql_num_rows($cek);
						if($cek_posting !== 0){
							?>
							<form action="?page=./transaksi/posting" method="post" name="postform">
							<input type="submit" onclick="return confirm('Apakah Anda Yakin?')" name="posting" value="POSTING JURNAL" />
							</form>
							
						<?php
						}
						?>
						</td>
					</tr>
					<tr>
						<td width="601" align="center">
							<font face="verdana" color="#666666">
							<?php
							//untuk mendecode url yang di enrypsi
							//$var=decode($_SERVER['REQUEST_URI']);
							//pecahkan nilai array
							if(isset($_GET['status'])){
								echo $page=$_GET['status'];
							}
							?>
							</font>			
						</td>
					</tr>
				</table>
			</p>
		</div>
	</div>

	
	<?php
	if(isset($_POST['posting'])){
		///////////////////////// HITUNG MUTASI /////////////////////
		$query_hitung_mutasi = mysql_query("SELECT kode_rekening FROM tabel_transaksi WHERE keterangan_posting = ''");
		
		while($row_hit_mut = mysql_fetch_array($query_hitung_mutasi)){
			$kode_rekening = $row_hit_mut['kode_rekening'];	
			$update_mutasi = mysql_query("UPDATE tabel_master SET mut_debet = mut_debet + (SELECT debet FROM tabel_transaksi WHERE kode_rekening ='".$kode_rekening."' AND keterangan_posting =''), mut_kredit = mut_kredit + (SELECT kredit FROM tabel_transaksi WHERE kode_rekening ='".$kode_rekening."' AND keterangan_posting='') WHERE kode_rekening = '".$kode_rekening."'");
		}
		
		if($query_hitung_mutasi){
			$query_hitung_sisa = mysql_query("SELECT  * FROM tabel_master");
			while($row_hit_sisa = mysql_fetch_array($query_hitung_sisa)){
			
				$normal        = $row_hit_sisa['normal'];
				$kode_rekening = $row_hit_sisa['kode_rekening'];
				$posisi		   = $row_hit_sisa['posisi'];
				
				$awal_debet    = $row_hit_sisa['awal_debet'];
				$awal_kredit   = $row_hit_sisa['awal_kredit'];
				
				$mutasi_debet  = $row_hit_sisa['mut_debet'];
				$mutasi_kredit = $row_hit_sisa['mut_kredit'];
					
			
				if($normal == "debet"){
					$hitung_sisa_debet = ($awal_debet + $mutasi_debet) - $mutasi_kredit;
					
					if($hitung_sisa_debet < 0){
						$positif_sisa_kredit = abs($hitung_sisa_debet);
						$update_mutasi       = mysql_query("UPDATE tabel_master SET sisa_debet = 0, sisa_kredit='".$positif_sisa_kredit."' WHERE kode_rekening='".$kode_rekening."'");
						
						if($posisi = 'rugi-laba'){
							//echo "Posisi : RUGI_LABA, Kode Rekening : ".$kode_rekening.", Jumlah : ".$positif_sisa_kredit;
							
							$update_rl = mysql_query("UPDATE tabel_rugi_laba SET rl_debet = '".$positif_sisa_kredit."' WHERE kode_rekening='".$kode_rekening."'");
						}
						
					}else{
						$update_mutasi       = mysql_query("UPDATE tabel_master SET sisa_debet = '".$hitung_sisa_debet."', sisa_kredit = '0' WHERE kode_rekening='".$kode_rekening."'");
						if($posisi = 'rugi-laba'){
							//echo "Posisi : RUGI_LABA, Kode Rekening : ".$kode_rekening.", Jumlah : ".$hitung_sisa_debet;
							
							$update_rl = mysql_query("UPDATE tabel_rugi_laba SET rl_debet = '".$hitung_sisa_debet."' WHERE kode_rekening='".$kode_rekening."'");
						}
					}
					
					$cari_total_biaya   = mysql_query("SELECT SUM(rl_debet) AS X FROM tabel_rugi_laba WHERE normal = 'debet'");
					while($nilai = mysql_fetch_array($cari_total_biaya)){
						$theNilai = $nilai['X'];
					}
					mysql_query("UPDATE tabel_rugi_laba SET rl_debet = '".$theNilai."' WHERE nama_rekening = 'JUMLAH BIAYA'");
								
				}
				
				if($normal == "kredit"){
					$hitung_sisa_kredit = ($awal_kredit + $mutasi_kredit) - $mutasi_debet;
					
					if($hitung_sisa_kredit < 0){
						$positif_sisa_debet = abs($hitung_sisa_kredit);
						$update_mutasi      = mysql_query("UPDATE tabel_master SET sisa_debet='".$positif_sisa_debet."', sisa_kredit ='0' WHERE kode_rekening='".$kode_rekening."'");
						
						if($posisi = 'rugi-laba'){
							//echo "Posisi : RUGI_LABA, Kode Rekening : ".$kode_rekening.", Jumlah : ".$positif_sisa_debet;
							
							$update_rl = mysql_query("UPDATE tabel_rugi_laba SET rl_kredit = '".$positif_sisa_debet."' WHERE kode_rekening='".$kode_rekening."'");
							
						}
					}else{
						$update_mutasi      = mysql_query("UPDATE tabel_master SET sisa_debet = 0, sisa_kredit='".$hitung_sisa_kredit."' WHERE kode_rekening='".$kode_rekening."'");
						
						if($posisi = 'rugi-laba'){
							//echo "Posisi : RUGI_LABA, Kode Rekening : ".$kode_rekening.", Jumlah : ".$positif_sisa_debet;
							
							$update_rl = mysql_query("UPDATE tabel_rugi_laba SET rl_kredit = '".$hitung_sisa_kredit."' WHERE kode_rekening='".$kode_rekening."'");
						}
					}
	
					$cari_total_pendapatan   = mysql_query("SELECT SUM(rl_kredit) AS X FROM tabel_rugi_laba WHERE normal = 'kredit'");
					while($nilai = mysql_fetch_array($cari_total_pendapatan)){
						$theNilai = $nilai['X'];
					}
					
					$nilai_total_pendapatan = 
					mysql_query("UPDATE tabel_rugi_laba SET rl_kredit = '".$theNilai."' WHERE nama_rekening = 'JUMLAH PENDAPATAN'");	
				}
			}
		}
				
		
		////////////////////////// UBAH STATUS POSTING //////////////////////////////
		$selesai = mysql_query("UPDATE tabel_transaksi SET tanggal_posting ='".$tanggal."', keterangan_posting = 'Post' WHERE keterangan_posting =''");
		
	}else{
		unset($_POST['posting']);
	}
	?>

<?php 
}else{
	echo "Forbidden Access!";
}
?>

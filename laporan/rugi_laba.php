<?php 
if (isset($_SESSION['id_admin']))
{
?>	
	<div class = "post">
		<div class = "entry">
			<?php
			//untuk ID perusahaan
			include "profil_perusahaan.php";
			$periode = mysql_fetch_array(mysql_query("SELECT tanggal_awal FROM tabel_rugi_laba WHERE kode_rekening = 'VII'"));
			?>
			<h2 align="center">
				<strong>Rugi Laba</strong>
			</h2>
			<p align="center">
				<font color="#333333"><?php echo "Periode : ".$periode['tanggal_awal'];?></font>
			</p>
			<p align="center">&nbsp;</p>
			<p>
			<table class="datatable">
				<tr>
					<th>Kode Perkiraan</th>
					<th>Uraian</th>
					<th>Pengeluaran</th>
					<th>Pendapatan</th>
				</tr>
				<tr>
					<td align="center"><strong>I.</strong></td>
					<td><strong><font color="#333333">PENDAPATAN</font></strong></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$pendapatan = mysql_query("SELECT * FROM tabel_rugi_laba WHERE kode_rekening LIKE '411%' ");
				while($row = mysql_fetch_array($pendapatan)){
				?>
					<tr>
						<td align="center"><?php echo $row['kode_rekening'];?></td>
						<td><?php echo $row['nama_rekening'];?></td>
						<td align="right"><?php echo number_format($row['rl_debet'],0,'.',','); ?></td>
						<td align="right"><?php echo number_format($row['rl_kredit'],0,'.',','); ?></td>
					</tr>
				<?php
				}
				?>
				<tr>
					<td colspan = "4">
				</tr>
				<tr>
					<td align="center"><strong>II.</strong></td>
					<td><strong><font color="#333333">BIAYA</font></strong></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$biaya_gaji = mysql_query("SELECT * FROM tabel_rugi_laba WHERE kode_rekening = '511.01'");
				while($row_biaya_gaji = mysql_fetch_array($biaya_gaji)){
				?>
					<tr>
						<td align="center"><?php echo $row_biaya_gaji['kode_rekening'];?></td>
						<td><?php echo $row_biaya_gaji['nama_rekening'];?></td>
						<td align="right"><?php echo number_format($row_biaya_gaji['rl_debet'],0,'.',','); ?></td>
						<td align="right"><?php echo number_format($row_biaya_gaji['rl_kredit'],0,'.',','); ?></td
					</tr>
				<?php
				}
				?>
				<?php
				$biaya_lain = mysql_query("SELECT * FROM tabel_rugi_laba WHERE kode_rekening = '511.02'");
				while($row_biaya_lain = mysql_fetch_array($biaya_lain)){
				?>
					<tr>
						<td align="center"><?php echo $row_biaya_lain['kode_rekening'];?></td>
						<td><?php echo $row_biaya_lain['nama_rekening'];?></td>
						<td align="right"><?php echo number_format($row_biaya_lain['rl_debet'],0,'.',','); ?></td>
						<td align="right"><?php echo number_format($row_biaya_lain['rl_kredit'],0,'.',','); ?></td>
					</tr>
				<?php
				}
				?>
				
				<tr>
					<td colspan="4">
				</tr>
				<?php
				$pendapatan = mysql_fetch_array(mysql_query("SELECT * FROM tabel_rugi_laba WHERE nama_rekening = 'JUMLAH PENDAPATAN'"));
				?>
				<tr>
					<td></td>
					<td><font color="#333333">JUMLAH PENDAPATAN</font></td>
					<td align="right"><?php echo number_format($pendapatan['rl_debet'],0,'.',','); ?></td>
					<td align="right"><?php echo number_format($pendapatan['rl_kredit'],0,'.',','); ?></td>
				</tr>
							
				<?php
				$jumlah_biaya = mysql_fetch_array(mysql_query("SELECT * FROM tabel_rugi_laba WHERE nama_rekening = 'JUMLAH BIAYA'"));
				?>
				<tr>
					<td></td>
					<td><font color="#333333">JUMLAH BIAYA </font></td>
					<td align="right"><?php echo number_format($jumlah_biaya['rl_debet'],0,'.',','); ?></td>
					<td align="right"><?php echo number_format($jumlah_biaya['rl_kredit'],0,'.',','); ?></td>
				</tr>
						
				<tr>
					<td colspan="4">
				</tr>
				
				<?php
				//$total_balance = mysql_fetch_array(mysql_query("SELECT * FROM tabel_rugi_laba WHERE nama_rekening ='Total Balance'"));
				
				$qry_cari = mysql_query("SELECT SUM(rl_debet) AS TOTRL_DEBET, SUM(rl_kredit) AS TOTRL_KREDIT FROM tabel_rugi_laba WHERE normal IN ('debet','kredit')");
				
				while($nilai = mysql_fetch_array($qry_cari)){
					$jumlahPendapatan = $nilai['TOTRL_KREDIT'];
					$jumlahBiaya = $nilai['TOTRL_DEBET'];
				}
		
				$rugiAtauLaba = $jumlahPendapatan - $jumlahBiaya;
				//echo $rugiAtauLaba;
				$warna = $rugiAtauLaba < 0 ? "red" : "blue";
				?>
				<tr>
					<td></td>
					<td><strong><font color="#333333">LABA / RUGI</font></strong></td>
					<td align="right" colspan="2"><strong><font color="<?=$warna;?>"><?php echo number_format($rugiAtauLaba,0,'.',','); ?></font></strong></td>
				</tr>
			</table>
			
			</p>
		</div>
	</div>

<?php
}else{
	echo "Forbidden Access!";
}
?>


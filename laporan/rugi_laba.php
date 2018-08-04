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
			<p align="center"><font color="#333333"><?php echo "Periode : ".$periode['tanggal_awal'];?></font></p>
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
					<td align="center">I.</td><td><font color="#333333">PENDAPATAN</font></td>
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
						<td align="right"><?php echo number_format($row['rl_debet'],2,'.',','); ?></td>
						<td align="right"><?php echo number_format($row['rl_kredit'],2,'.',','); ?></td>
					</tr>
				<?php
				}
				?>
				<tr>
					<td colspan = "4">
				</tr>
				<tr>
					<td align="center">II.</td>
					<td><font color="#333333">BIAYA-BIAYA</font></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><font color="#333333">BIAYA GAJI</font></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$biaya_gaji = mysql_query("SELECT * FROM tabel_rugi_laba WHERE kode_rekening = '511.01'");
				while($row_umum = mysql_fetch_array($biaya_gaji)){
				?>
					<tr>
						<td align="center"><?php echo $row_umum['kode_rekening'];?></td>
						<td><?php echo $row_umum['nama_rekening'];?></td>
						<td align="right"><?php echo number_format($row_umum['rl_debet'],2,'.',','); ?></td>
						<td align="right"><?php echo number_format($row_umum['rl_kredit'],2,'.',','); ?></td
					</tr>
				<?php
				}
				?>
				
				<tr>
					<td></td>
					<td><font color="#333333">BIAYA LAIN-LAIN</font></td>
					<td></td>
					<td></td>
				</tr>
				<?php
				$biaya_lain2 = mysql_query("SELECT * FROM tabel_rugi_laba WHERE kode_rekening = '511.02'");
				while($row_biaya1 = mysql_fetch_array($biaya_lain2)){
				?>
					<tr>
						<td align="center"><?php echo $row_biaya1['kode_rekening'];?></td>
						<td><?php echo $row_biaya1['nama_rekening'];?></td>
						<td align="right"><?php echo number_format($row_biaya1['rl_debet'],2,'.',','); ?></td>
						<td align="right"><?php echo number_format($row_biaya1['rl_kredit'],2,'.',','); ?></td>
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
					<td align="right"><?php echo number_format($pendapatan['rl_debet'],2,'.',','); ?></td>
					<td align="right"><?php echo number_format($pendapatan['rl_kredit'],2,'.',','); ?></td>
				</tr>
							
				<?php
				$jumlah_biaya = mysql_fetch_array(mysql_query("SELECT * FROM tabel_rugi_laba WHERE nama_rekening = 'JUMLAH BIAYA'"));
				?>
				<tr>
					<td></td>
					<td><font color="#333333">JUMLAH BIAYA </font></td>
					<td align="right"><?php echo number_format($jumlah_biaya['rl_debet'],2,'.',','); ?></td>
					<td align="right"><?php echo number_format($jumlah_biaya['rl_kredit'],2,'.',','); ?></td>
				</tr>
						
				<tr>
					<td colspan="4">
				</tr>
				
				<?php
				$total_balance = mysql_fetch_array(mysql_query("SELECT * FROM tabel_rugi_laba WHERE nama_rekening ='Total Balance'"));
				?>
				<tr>
					<td></td>
					<td><font color="#333333">Total Balance</font></td>
					<td align="right"><?php echo number_format($total_balance['rl_debet'],2,'.',','); ?></td>
					<td align="right"><?php echo number_format($total_balance['rl_kredit'],2,'.',','); ?></td>
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


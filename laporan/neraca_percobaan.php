<?php 

if (isset($_SESSION['id_admin']))
{
?>	
	<div class="post">
	<div class="entry">
			<?php
			//untuk ID perusahaan
			include "profil_perusahaan.php";
			?>
			
			<h2 align="center"><strong>Neraca Percobaan</strong></h2>
			<p align="center">&nbsp;</p>
			<p>
			<table class="datatable" border="1">
			<tr>
			  <th rowspan="2">Kode Rekening</th>
			  <th rowspan="2">Nama Rekening</th>
			  <th colspan="2">Awal</th>
			  <th colspan="2">Mutasi</th>
			  <th colspan="2">Sisa</th>
			  </tr>
			<tr>
				<th>Debet</th>
				<th>Kredit</th><th>Debet</th><th> Kredit</th><th>Debet</th><th>Kredit</th>
			</tr>
			<?php
			$query_mutasi = mysql_query("SELECT * FROM tabel_master ORDER BY kode_rekening ASC");
			$total        = mysql_fetch_array(mysql_query("SELECT SUM(awal_debet) AS tot_awal_debet, SUM(awal_kredit) AS tot_awal_kredit, SUM(mut_debet) AS tot_mut_debet,  SUM(mut_kredit) AS tot_mut_kredit,
								SUM(sisa_debet) AS tot_sisa_debet, SUM(sisa_kredit) AS tot_sisa_kredit FROM tabel_master ORDER BY kode_rekening ASC"));
			
			while($row_mut = mysql_fetch_array($query_mutasi)){
			
				$awal_debet    = $row_mut['awal_debet'];
				$awal_kredit   = $row_mut['awal_kredit'];
				$mutasi_debet  = $row_mut['mut_debet'];
				$mutasi_kredit = $row_mut['mut_kredit'];
				$sisa_debet    = $row_mut['sisa_debet'];
				$sisa_kredit   = $row_mut['sisa_kredit'];
			
				?>
				<tr>
					<td><div align="center"><?php echo $row_mut['kode_rekening'];?></div></td>
					<td><?php echo $row_mut['nama_rekening'];?></td>
					
					<td align="right"><?php echo number_format($awal_debet,0,'.',','); ?></td>
					<td align="right"><?php echo number_format($awal_kredit,0,'.',','); ?></td>	
					
					<td align="right"><?php echo number_format($mutasi_debet,0,'.',','); ?></td>
					<td align="right"><?php echo number_format($mutasi_kredit,0,'.',','); ?></td>	
					
					<td align="right"><?php echo number_format($sisa_debet,0,'.',','); ?></td>
					<td align="right"><?php echo number_format($sisa_kredit,0,'.',','); ?></td>					
				</tr>
				<?php
			}
			?>
			<tr>
				<td colspan="2"><div align="center"><strong>TOTAL TRANSAKSI</strong></div></td>
				<td>
					<div align="right"><strong><?php echo number_format($total['tot_awal_debet'],0,'.',','); ?></strong></div>
				</td>
				<td>
					<div align="right"><strong><?php echo number_format($total['tot_awal_kredit'],0,'.',','); ?></strong></div>
				</td>
				<td>
					<div align="right"><strong><?php echo number_format($total['tot_mut_debet'],0,'.',','); ?></strong></div></td>
				<td>
					<div align="right"><strong><?php echo number_format($total['tot_mut_kredit'],0,'.',','); ?></strong></div></td>
				<td>
					<div align="right"><strong><?php echo number_format($total['tot_sisa_debet'],0,'.',','); ?></strong></div>
				</td>
				<td>
					<div align="right"><strong><?php echo number_format($total['tot_sisa_kredit'],0,'.',','); ?></strong></div>
				</td>
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

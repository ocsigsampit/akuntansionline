<?php 

if (isset($_SESSION['id_admin']))
{	
	$query_tanggal=mysql_fetch_array(mysql_query("select min(tanggal_posting) as tanggal_pertama from tabel_transaksi"));
	$tanggal_pertama=$query_tanggal['tanggal_pertama'];
?>

	<div class="post">
	<div class="entry">
		<form action="?page=./laporan/buku_jurnal" method="post" name="postform">
		  <table width="531" border="0">
			<tr>
			  <td width="48"><strong>Periode</strong></td>
			  <td colspan="2"><input type="text" name="tanggal1" size="15"/>
			  <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal1);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a></td>
			  <td width="24"><strong>S/D</strong></td>
			  <td colspan="2"><input type="text" name="tanggal2" size="15"/>
			  <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal2);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a></td>
			  <td width="77"><input type="submit" name="report" value="Tampilkan" /></td>
			</tr>
		  </table>
		</form>
	</div>
	</div>


	<div class="post">
		<div class="entry">
			<p>
			<?php
			//untuk menyelesaikan transaksi
			if(isset($_POST['report'])){
				
				//tanggal periode laporan
				$tanggal1=$_POST['tanggal1'];
				$tanggal2=$_POST['tanggal2'];
				
				$query_transaksi=mysql_query("select * from tabel_transaksi where tanggal_transaksi between '$tanggal1' and '$tanggal2' order by tanggal_transaksi asc");
				$total=mysql_fetch_array(mysql_query("select sum(debet) as tot_debet, sum(kredit) as tot_kredit from tabel_transaksi where tanggal_transaksi between '$tanggal1' and '$tanggal2' order by kode_rekening asc"));
	
			}else{
			
				$query_transaksi=mysql_query("select * from tabel_transaksi order by tanggal_transaksi asc");
				$total=mysql_fetch_array(mysql_query("select sum(debet) as tot_debet, sum(kredit) as tot_kredit from tabel_transaksi order by kode_rekening asc"));
			
				unset($_POST['report']);
			}
			?>
			
			<?php
			//untuk ID perusahaan
			include "profil_perusahaan.php";
			?>
			
			<h2 align="center"><strong>Buku Jurnal</strong></h2>
			<p align="center"><font color="#333333"><?php if(!empty($tanggal2)){ echo "Periode ".$tanggal2;} ?></font></p>
			<p align="center">&nbsp;</p>
			<table class="datatable" border="1">
			<tr>
				<th>Tanggal</th><th>Nomor Bukti</th><th>Kode Rekening</th><th>Keterangan</th><th>Debet</th><th>Kredit</th>
			</tr>
			<?php
			
			while($row_tran=mysql_fetch_array($query_transaksi)){
				$debet=$row_tran['debet'];
				$kredit=$row_tran['kredit'];
				
				?>
				<tr>
					<td><div align="center"><?php echo $row_tran['tanggal_transaksi'];?></div></td>
					<td><div align="center"><?php echo $row_tran['kode_transaksi'];?></div></td>
					<td><div align="center"><?php echo $row_tran['kode_rekening'];?></div></td>
					<td><?php echo $row_tran['keterangan_transaksi'];?></td>
					<td align="right"><?php echo number_format($debet,2,'.',','); ?></td>
					<td align="right"><?php echo number_format($kredit,2,'.',','); ?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td colspan="4"><div align="center"><strong>TOTAL TRANSAKSI</strong></div></td>
				<td align="right"><strong><?php echo number_format($total['tot_debet'],2,'.',','); ?></strong></td>
				<td align="right"><strong><?php echo number_format($total['tot_kredit'],2,'.',','); ?></strong></td>
			</tr>
			</table>

			
			</p>
		</div>
	</div>
	
	
	<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>


<?php 
}else{
	echo "Forbidden Access!";
}
?>
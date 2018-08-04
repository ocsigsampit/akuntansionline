<?php 
if (isset($_SESSION['id_admin']))
{
?>
	<body onLoad="document.form.elements['kode_rekening'].focus();">
	<div class="post">
		<div class="entry">
			<h2 align="center"><strong>Perkiraan</strong></h2>
			<p align="center">&nbsp;</p>
			<p>
			<form action="?page=./setup/perkiraan" method="post" name="form">
			<table>
			<tr>
				<td>Kode Rekening</td><td><input type="text" name="kode_rekening" size="15"/></td>
			</tr>
				<tr>
				<td>Nama Rekening</td><td><input type="text" name="nama_rekening" size="30"/></td>
			</tr>
				<tr>
				<td>Normal Balance</td>
				<td>
				<select name="normal">
					<option value="debet">Debet</option>
					<option value="kredit">Kredit</option>
				</select>
				</td>
			</tr>
				<tr>
				<td>Posisi</td>
				<td>
				
				<select name="posisi">
					<option value="neraca">Neraca</option>
					<option value="rugi-laba">Rugi Laba</option>
				</select>
				
				</td>
			</tr>
			<tr>
				<td>Saldo Awal Debet</td><td><input type="text" name="awal_debet" size="15"/></td>
			</tr>
			<tr>
				<td>Saldo Akhir Debet</td><td><input type="text" name="awal_kredit" size="15"/></td>
			</tr>
			<tr>
				<td><input type="submit" value="Simpan" /></td>
			</tr>
			</table>
			</form>
			
			<br />
			<!---MENAMPILKAN TABEL PERKIRAAN--->
			<a href="./laporan~pdf/perkiraan~pdf.php" target="_blank" title=" Tampilkan dalam file pdf">
			<img src="images/pdf-icon.jpeg" border="0"/>
			</a>
			<table class="datatable">
			<tr>
				<th>Kode Rekening</th><th>Nama Rekening</th><th>Awal Debet</th><th>Awal Kredit</th><th>Posisi</th><th>Normal</th>
			</tr>
			<?php
			$total=mysql_fetch_array(mysql_query("select sum(awal_debet) as tot_awal_debet,sum(awal_kredit) as tot_awal_kredit from tabel_master order by kode_rekening asc"));
			$query=mysql_query("select * from tabel_master order by kode_rekening asc");
			while($row=mysql_fetch_array($query)){
				?>
				<tr>
					<td align="center"><?php echo $row['kode_rekening'];?></td><td><?php echo $row['nama_rekening'];?></td>
					<td align="right"><?php echo $row['awal_debet'];?></td><td align="right"><?php echo $row['awal_kredit'];?></td>
					<td><?php echo $row['posisi'];?></td><td><?php echo $row['normal'];?></td>
				</tr>
				<?php
			}
			?>
			<tr>
				<td colspan="2" align="center"><strong>JUMLAH</strong></td>
				<td align="right"><strong><?php echo number_format($total['tot_awal_debet'],2,'.',','); ?></strong></td>
				<td align="right"><strong><?php echo number_format($total['tot_awal_kredit'],2,'.',','); ?></strong></td>
				<td colspan="2" align="center">
				<?php
				//untuk menghitung balance
				if(!empty($total['tot_awal_debet']) || !empty($total['tot_awal_kredit'])){
					if($total['tot_awal_debet']==$total['tot_awal_kredit']){
						echo "<font color='#0033FF'>Balance</font>";
					}else{
						echo "<font color=red>Not Balance : ".abs($total['tot_awal_debet']-$total['tot_awal_kredit'])."</font>";
					}
				}
				?>
				</td>
			</tr>
			</table>
			
			
			</p>
		</div>
	</div>
	</body>
	
	
	<?php
	if(isset($_POST['kode_rekening'])){
	
		$kode_rekening=$_POST['kode_rekening'];
		$nama_rekening=ucwords($_POST['nama_rekening']);
		$normal=$_POST['normal'];
		$posisi=$_POST['posisi'];
		$awal_debet=$_POST['awal_debet'];
		$awal_kredit=$_POST['awal_kredit'];
		
		$query=mysql_query("insert into tabel_master(kode_rekening,nama_rekening,tanggal_awal,awal_debet,awal_kredit,posisi,normal) 
							values('$kode_rekening','$nama_rekening','$tanggal','$awal_debet','$awal_kredit','$posisi','$normal')");
		
		if($query){
			?><script language="javascript">alert("Data sudah tersimpan")</script><?php
			?><script language="javascript">document.location.href="?page=./setup/perkiraan"</script><?php
		}else{
			echo mysql_error();
		}
		echo "masuk";
	}else{
		unset($_POST['kode_rekening']);
	}
	?>
	
<?php 
}else{
	echo "Forbidden Access!";
}
?>
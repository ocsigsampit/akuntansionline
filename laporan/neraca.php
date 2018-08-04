<?php 

if (isset($_SESSION['id_admin']))
{
	$query_tanggal = mysql_fetch_array(mysql_query("SELECT MIN(tanggal_posting) AS tanggal_pertama FROM tabel_transaksi"));
	$tanggal_pertama = $query_tanggal['tanggal_pertama'];
?>

	<div class="post">
	<div class="entry">
		<form action="?page=./laporan/neraca" method="post" name="postform">
		  <table width="715" border="0">
			<tr>
			  <td width="51"><strong>Periode</strong></td>
			  <td colspan="2"><input type="text" name="tanggal1" size="15" value="<?php if(empty($_POST['tanggal1'])){ echo $tanggal_pertama;}else{ echo $_POST['tanggal1']; }?>"/>
			  <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal1);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a></td>
			  <td width="25"><strong>S/D</strong></td>
			  <td colspan="2"><input type="text" name="tanggal2" size="15" value="<?php if(empty($_POST['tanggal2'])){ echo $tanggal;}else{ echo $_POST['tanggal2']; }?>"/>
			  <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal2);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a></td>
			  <td width="126">
			  <select name="neraca">
					<option value="aktiva">Neraca Aktiva</option>
					<option value="pasiva">Neraca Pasiva</option>
			  </select>
			  </td>
			  <td width="157"><input type="submit" name="report" value="Tampilkan" /></td>
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
			$tanggal1 = $_POST['tanggal1'];
			$tanggal2 = $_POST['tanggal2'];
			$neraca   = $_POST['neraca'];
			
			function aktiva(){

				///////////////////HITUNG AKTIVA////////////////////
				//hapus table semporial yang lama
				$hapus_neraca_temporial = mysql_query("DELETE FROM tabel_neraca");
				
				if($hapus_neraca_temporial){
					//Query aktiva LANCAR
					$query_kas          = mysql_fetch_array(mysql_query("SELECT SUM(sisa_debet) AS kas FROM tabel_master WHERE kode_rekening LIKE '111%'"));
					$query_bank         = mysql_fetch_array(mysql_query("SELECT SUM(sisa_debet) AS bank FROM tabel_master WHERE kode_rekening LIKE '112%'"));
					$query_piutang      = mysql_fetch_array(mysql_query("SELECT sum(sisa_debet) AS piutang FROM tabel_master WHERE kode_rekening LIKE '113%'"));
					
					
					//Array Query
					$kas             = $query_kas['kas'];
					$bank            = $query_bank['bank'];
					$piutang         = $query_piutang['piutang'];
					
					
					
					//Proses Query
					//$bank =$bank1+$bank2;
					
					//menghitung saldo akhir aktiva lancar
					$aktiva_lancar = $kas + $bank + $piutang;
					
					//Query aktiva TETAP
					$query_gedung_mesin  = mysql_fetch_array(mysql_query("SELECT sum(sisa_debet) AS gedung_mesin FROM tabel_master WHERE kode_rekening LIKE '133%'"));
					
					//Array Query
					$gedung_mesin  = $query_gedung_mesin['gedung_mesin'];
					
					//Perhitungan
					$aktiva_tetap = $gedung_mesin;
			
					$jumlah_aktiva = $aktiva_lancar + $aktiva_tetap;
					
					//Tahap penginputan Data
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('0','<b>AKTIVA LANCAR</b>')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('1','Kas', '$kas')");
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('2','Bank', '$bank')");
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('3','Piutang', '$piutang')");
					
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('5','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('6','Total Aktiva Lancar', '$aktiva_lancar')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('7','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('8','<b>AKTIVA TETAP</b>')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('9','Gedung dan Mesin', '$gedung_mesin')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('10','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('11','Total Aktiva Tetap', '$aktiva_tetap')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening) values('12')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('13','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('14','<b>JUMLAH AKTIVA</b>', '$jumlah_aktiva')");
					
					$query_report = mysql_query("SELECT * FROM tabel_neraca");
					
					?>
					<h3 align="left"><b>Neraca (Balance Sheet)</b></h3><br />
					<font color="#333333">Periode : <?php echo $tanggal2=$_POST['tanggal2']; ?></font>
					<h3 align="right"><b>AKTIVA</b></h3><br />
					<table class="datatable">
					<tr><th>URAIAN</th><th>NILAI</th></tr>
					<?php
					while($row = mysql_fetch_array($query_report)){
						$nama_rekening  = $row['nama_rekening'];
						$awal_debet     = number_format($row['awal_debet'],2,'.',',');
						
						if($nama_rekening == 'break'){
							?><tr><td colspan="2"></td></tr><?php
						}else{
							?><tr><td><?php echo $nama_rekening ?></td><td align="right"><?php echo $awal_debet;?></td></tr><?php
						}
					}
					?>
					</table>
					<?php
					
				}else{
					echo mysql_error();
				}
			}
				 
			function pasiva(){
				///////////////////HITUNG PASIVA////////////////////
				//hapus table Temporial yang lama
				$hapus_neraca_temporial = mysql_query("DELETE FROM tabel_neraca");
				
				if($hapus_neraca_temporial){
					 //Hutang jangka pendek
					$query_utang       = mysql_fetch_array(mysql_query("SELECT sum(sisa_kredit) AS utang FROM tabel_master WHERE kode_rekening LIKE '211%'"));
					$query_biaya_gaji  = mysql_fetch_array(mysql_query("SELECT sum(sisa_debet) AS biaya_gaji FROM tabel_master WHERE kode_rekening = '511.01'"));
					$query_biaya_lain2 = mysql_fetch_array(mysql_query("SELECT sum(sisa_debet) AS biaya_lain2 FROM tabel_master WHERE kode_rekening = '511.02'"));
					
					$query_pendapatan   = mysql_fetch_array(mysql_query("SELECT sum(sisa_kredit) AS pendapatan FROM tabel_master WHERE kode_rekening LIKE '411%'"));
						
					//menghitung modal
					$query_modal = mysql_fetch_array(mysql_query("SELECT sum(sisa_kredit) AS modal FROM tabel_master WHERE kode_rekening='313.01'"));
					
					//Array Query
					$utang       = $query_utang['utang'];
					$biaya_gaji  = $query_biaya_gaji['biaya_gaji'];
					$biaya_lain2 = $query_biaya_lain2['biaya_lain2'];
	
					//Array Query
					$modal = $query_modal['modal'];
					
					//Proses Perhitungan
					$jumlah_biaya = $biaya_gaji + $biaya_lain2;
					
					$pendapatan   = $query_pendapatan['pendapatan'];
					
					$labarugi = $pendapatan - $jumlah_biaya;
					
					$total_pasiva = $modal + $utang + $pendapatan - $jumlah_biaya;	
					
					
					//Tahap penginputan Data
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('0','<b>UTANG</b>')");
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('1','Utang', '$utang')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('2','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('3','<b>PENDAPATAN</b>')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_kredit) values('4','Pendapatan', '$pendapatan')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('5','<b>BIAYA-BIAYA</b>')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('6','Biaya Gaji', '$biaya_gaji')");
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('7','Biaya Lain-lain', '$biaya_lain2')");

					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('8','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('9','<b>MODAL</b>')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('10','Modal', '$modal')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values('11','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('12','Laba / Rugi', '$labarugi')");
						
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening) values ('13','break')");
					
					mysql_query("INSERT INTO tabel_neraca(kode_rekening, nama_rekening, awal_debet) values('14','<b>JUMLAH PASIVA</b>', '$total_pasiva')");

					$query_report=mysql_query("select * from tabel_neraca");
					
					?>
					<h3 align="left"><b>Neraca (Balance Sheet)</b></h3><br />
					<font color="#333333">Periode : <?php echo $tanggal2=$_POST['tanggal2']; ?></font>
					<h3 align="right"><b>PASIVA</b></h3><br />
					<table class="datatable">
					<tr><th>URAIAN</th><th>NILAI</th></tr>
					<?php
					while($row=mysql_fetch_array($query_report)){
						$nama_rekening=$row['nama_rekening'];
						$awal_debet=number_format($row['awal_debet'],2,'.',',');
						
						if($nama_rekening=='break'){
							?><tr><td colspan="2"></td></tr><?php
						}else{
							?><tr><td><?php echo $nama_rekening ?></td><td align="right"><?php echo $awal_debet;?></td></tr><?php
						}
					}
					?>
					</table>
					
				<?php
				}else{
					echo mysql_error();
				}
			}
				 
			//tampilkan profil perusahaan
			include "profil_perusahaan.php";

			if($neraca=='aktiva'){
				 aktiva();
			}else if($neraca=='pasiva'){
				pasiva();
			}
			
			
			
		}else{	
			unset($_POST['report']);
		}
		?>
		
		</p>
		</div>
	</div>
	
	
	<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;"></iframe>
<?php 




}else{
	echo "Forbidden Access!";
}
?>
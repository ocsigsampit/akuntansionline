<?php 
if (isset($_SESSION['id_admin']))
{
?>
	<script type="text/javascript" src="jquery.js"></script>
	<script>
	function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}
	
	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 100);
	}
	
	function fill2(thisValue) {
		$('#kode').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 100);
	}
	</script>
	
	<style>
	#result {
		height:20px;
		font-size:12px;
		font-family:Arial, Helvetica, sans-serif;
		color:#333;
		padding:5px;
		margin-bottom:10px;
		background-color:#FFFF99;
	}
	#country{
		padding:3px;
		border:1px #CCC solid;
		font-size:12px;
	}
	.suggestionsBox {
		position: absolute;
		left: 0px;
		top:40px;
		margin: 26px 0px 0px 0px;
		width: 200px;
		padding:0px;
		background-color:#999999;
		border-top: 3px solid #999999;
		color: #fff;
	}
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	.suggestionList ul li {
		list-style:none;
		margin: 0px;
		padding: 6px;
		border-bottom:1px dotted #666;
		cursor: pointer;
	}
	.suggestionList ul li:hover {
		background-color: #FC3;
		color:#000;
	}
	ul {
		font-family:Arial, Helvetica, sans-serif;
		font-size:11px;
		color:#FFF;
		padding:0;
		margin:0;
	}
	
	.load{
	background-image:url(loader.gif);
	background-position:right;
	background-repeat:no-repeat;
	}
	
	#suggest {
		position:relative;
	}
	</style>

	<body onLoad="document.postform.elements['keterangan_transaksi'].focus();">
	<div class="post">
		<div class="entry">
			<h2 align="center"><strong>Jurnal Umum</strong></h2>
			<p align="center">&nbsp;</p>
			<p>
			<?php 
			//jurnal baru. cari nomor paling besar yaitu nomor jurnal terakhir 
			$jurnal_umum    = mysql_fetch_array(mysql_query("SELECT MAX(nomor_jurnal) FROM jurnal_umum ORDER BY tanggal_selesai DESC"));
			$nomor_jurnal   = $jurnal_umum[0]+1;
			$kode_transaksi = "BU/".$nomor_jurnal;
			?>
			<form action="?page=./transaksi/umum" method="post" name="postform">
				<table width="435" border="0">
					<tr>
						<td width="111">Nomor Bukti</td>
						<td colspan="2">
							<input type="hidden" name="kode_bukti" value="<?php echo $kode_transaksi;?>">
							<input type="text" disabled="disabled" value="<?php echo $kode_transaksi;?>" size="15"/>
						</td>
					</tr>
					<tr>
						<td>Tanggal</td>
						<td colspan="2">
							<input type="text" name="tanggal_transaksi" size="15" value="<?php if(empty($_POST['tanggal_transaksi'])){ echo $tanggal;}else{ echo $_POST['tanggal_transaksi']; }?>" />
							<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_transaksi);return false;" ><img src="calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>				
						</td>
					</tr>
					<tr>
						<td>Keterangan</td>
						<td colspan="2"><input type="text" value="<?php if(isset($_POST['keterangan_transaksi'])){ echo $_POST['keterangan_transaksi']; }?>" name="keterangan_transaksi" size="45"/></td>
					</tr>
					<tr>
						<td>Jumlah (Rp)</td>
						<td colspan="2">
							<input type="text" name="jumlah_dk" size="15"/>
						</td>
					</tr>
					<tr>
						<td>Nomor Rekening</td>
						<td width="107">
							<div id="suggest">
								<input type="text" onKeyUp="suggest(this.value);" name="kode_rekening"  onBlur="fill2();" id="kode" size="15"/> 
								<div class="suggestionsBox" id="suggestions" style="display: none;"> 
									<img src="arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
									<div class="suggestionList" id="suggestionsList">
										&nbsp; 
									</div>
								</div>
							</div>
						</td>
						<td width="203" align="left">
							<input type="text" disabled="disabled" name="nama_rekening" onBlur="fill();" id="country"  size="30"/>
						</td>
					</tr>
					<tr>
						<td>Posisi</td>
						<td colspan="2">
							<select name="posisi">
								<option value="debet">Debet</option>
								<option value="kredit">Kredit</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" value="Simpan" name="simpan">
						</td>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
			</form>
			<br />
			
			<?php
			//untuk menyimpan transaksi
			if(isset($_POST['simpan'])){
		
				$kode_transaksi       = $_POST['kode_bukti'];
				$tanggal_transaksi    = $_POST['tanggal_transaksi'];
				$keterangan_transaksi = ucwords($_POST['keterangan_transaksi']);
				$kode_rekening        = $_POST['kode_rekening'];
				
				$posisi               = $_POST['posisi'];
				$jumlah_dk            = ucwords($_POST['jumlah_dk']);
				
				if($posisi == 'debet'){
					$dk = 'debet';
				}else{
					$dk = 'kredit';
				}
				
				$query = mysql_query("INSERT INTO 
				tabel_transaksi(kode_transaksi,kode_rekening,tanggal_transaksi, jenis_transaksi, keterangan_transaksi,".$dk.",id_admin)
									VALUES ('$kode_transaksi','$kode_rekening','$tanggal_transaksi','Bukti Umum','$keterangan_transaksi','".$jumlah_dk."','".$id_admin."')");		
				if($query){
					//echo "berhasil";
				}else{
					echo mysql_error();
				}
				
			}else{
				unset($_POST['simpan']);
			}
			
			//untuk menyelesaikan transaksi
			if(isset($_POST['selesai'])){
				$kode_transaksi    = $_POST['kode_bukti'];
				$nomor_jurnal      = $_POST['nomor_jurnal'];
				$tanggal_selesai   = $_POST['tanggal_selesai'];
				
				$query = mysql_query("insert into jurnal_umum(nomor_jurnal,kode_transaksi,tanggal_selesai) values('".$nomor_jurnal."','".$kode_transaksi."','".$tanggal_selesai."')");
									
				if($query){
					?><script language="javascript">document.location.href="?page=./transaksi/umum"</script><?php
				}else{
					echo mysql_error();
				}
				
			
			}else{
				unset($_POST['selesai']);
			}
			
			
			//untuk mendecode url yang di enrypsi
			//$var=decode($_SERVER['REQUEST_URI']);
	
			if(isset($_GET['mode']) && isset($_GET['id_transaksi'])){
			
				//pecahkan nilai array
				$mode         = $_GET['mode'];
				$id_transaksi = $_GET['id_transaksi'];
				
				if($mode == 'delete'){
					$query = mysql_query("DELETE FROM tabel_transaksi WHERE id_transaksi = '".$id_transaksi."'");
				}
				
			}
			
			
			//untuk menampilkan data
			?>
			<table class="datatable">
				<tr>
					<th>Kode Rekening</th>
					<th>Keterangan</th>
					<th>Debet</th>
					<th>Kredit</th>
					<th>Action</th>
				</tr>
				<?php
				
				$tot_debet  = 0;
				$tot_kredit = 0;
				
				$query = mysql_query("SELECT * FROM tabel_transaksi WHERE kode_transaksi='".$kode_transaksi."' AND id_admin ='".$id_admin."'");
				while($row = mysql_fetch_array($query)){
					$debet        = $row['debet'];
					$kredit       = $row['kredit'];
					$id_transaksi = $row['id_transaksi'];
					
					$tot_debet    = $tot_debet + $debet;
					$tot_kredit   = $tot_kredit + $kredit;
					
					?>
					<tr>
						<td><?php echo $row['kode_rekening'];?></td>
						<td><?php echo $row['keterangan_transaksi'];?></td>
						<td align="right"><?php if($debet!=="0"){echo number_format($debet,2,'.',',');}; ?></td>
						<td align="right"><?php if($kredit!=="0"){echo number_format($kredit,2,'.',',');}; ?></td>
						<td align="center">
							<a href="?page=./transaksi/umum&mode=delete&id_transaksi='<?php echo $id_transaksi; ?>" onClick="return confirm('Apakah Anda yakin?')">Cancel</a>
						</td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="2" align="center"><b>TOTAL</b></td>
					<td align="right"><b><?php if(!empty($tot_debet)){ echo number_format($tot_debet,2,'.',','); } ?></b></td>
					<td align="right"><b><?php if(!empty($tot_kredit)){ echo number_format($tot_kredit,2,'.',','); }?></b></td>
					<td align="center">
						<?php
						//untuk menghitung balance
						if(!empty($tot_debet) || !empty($tot_kredit)){
							if($tot_debet == $tot_kredit){
								echo "<font color='#0033FF'>Balance</font>";
							}else{
								echo "<font color=red>Not Balance : ".abs($tot_debet-$tot_kredit)."</font>";
							}
						}
						?>
					</td>
				</tr>
			</table>
			<br />			
			<form action="?page=./transaksi/umum" method="post" name="form">
				<input type="hidden" name="tanggal_selesai" size="15" value="<?php if(empty($_POST['tanggal_transaksi'])){ echo $tanggal;}else{ echo $_POST['tanggal_transaksi']; }?>"/>
				<input type="hidden" name="kode_bukti" value="<?php echo $kode_transaksi;?>">
				<input type="hidden" name="nomor_jurnal" value="<?php echo $nomor_jurnal;?>">
				<input type="submit" onClick="return confirm('Apakah Anda Yakin?')" value="Selesai" name="selesai"/>
			</form>
			
			</p>
		</div>
	</div>
	</body>
	<!--
	<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
	</iframe>
	-->
<?php 
}else{
	echo "Forbidden Access!";
}
?>
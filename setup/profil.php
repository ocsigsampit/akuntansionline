<?php 

if (isset($_SESSION['id_admin']))
{
?>
	<body onLoad="document.form.elements['nama_perusahaan'].focus();">
	<div class="post">
		<div class="entry">
		    <h2 align="center"><strong>Profil</strong></h2>
		    <p align="center">&nbsp;</p>
		    <p>
			<form action="?page=./setup/profil" method="post" name="form">
			<table>
			<tr><td>Nama Perusahaan</td><td><input type="text" name="nama_perusahaan" size="15"/></td></tr>
			<tr><td>Gedung</td><td><input type="text" name="gedung" size="30"/></td></tr>
			<tr><td>Jalan</td><td><input type="text" name="jalan" size="30"/></td></tr>
			<tr><td>Kelurahan</td><td><input type="text" name="kelurahan" size="30"/></td></tr>
			<tr><td>Kecamatan</td><td><input type="text" name="kecamatan" size="15"/></td></tr>
			<tr><td>Propinsi</td><td><input type="text" name="propinsi" size="15"/></td></tr>
			<tr><td>Negara</td><td><input type="text" name="negara" size="15"/></td></tr>
			<tr><td>Telpon</td><td><input type="text" name="telpon" size="15"/></td></tr>
			<tr><td>Fax</td><td><input type="text" name="fax" size="15"/></td></tr>
			<tr><td>Email</td><td><input type="text" name="email" size="15"/></td></tr>
			<tr><td>Website</td><td><input type="text" name="website" size="15"/></td></tr>
			<tr><td><input type="submit" value="Simpan" /></td></tr>
			</table>
			</form>
			<br />
			
			<!------MENAMPILKAN PROFIL PERUSAHAAN------->
			<table class="datatable">
			<tr>
				<th>ITEM</th><th></th><th>KETERANGAN</th>
			</tr>
			<?php
			$query=mysql_query("select * from tabel_profil");
			while($row=mysql_fetch_array($query)){
				?>
				<tr><td>Nama Perusahaan</td><td>:</td><td><?php echo $row['nama_perusahaan'];?></td></tr>
				<tr><td>Nama Gedung</td><td>:</td><td><?php echo $row['gedung'];?></td></tr>
				<tr><td>Jalan</td><td>:</td><td><?php echo $row['jalan'];?></td></tr>
				<tr><td>Kelurahan</td><td>:</td><td><?php echo $row['kelurahan'];?></td></tr>
				<tr><td>Kecamatan</td><td>:</td><td><?php echo $row['kecamatan'];?></td></tr>
				<tr><td>Propinsi</td><td>:</td><td><?php echo $row['propinsi'];?></td></tr>
				<tr><td>Negara</td><td>:</td><td><?php echo $row['negara'];?></td></tr>
				<tr><td>Telpon</td><td>:</td><td><?php echo $row['telpon'];?></td></tr>
				<tr><td>Fax</td><td>:</td><td><?php echo $row['fax'];?></td></tr>
				<tr><td>Email</td><td>:</td><td><?php echo $row['email'];?></td></tr>
				<tr><td>Website</td><td>:</td><td><?php echo $row['website'];?></td></tr>
			<?php	
			}
			?>
			</table>

			
			<?php
			if(isset($_POST['nama_perusahaan'])){
	
				$nama_perusahaan=ucwords($_POST['nama_perusahaan']);
				$gedung=ucwords($_POST['gedung']);
				$jalan=ucwords($_POST['jalan']);
				$kelurahan=ucwords($_POST['kelurahan']);
				$kecamatan=ucwords($_POST['kecamatan']);
				$propinsi=ucwords($_POST['propinsi']);
				$negara=ucwords($_POST['negara']);
				$telpon=$_POST['telpon'];
				$fax=$_POST['fax'];
				$email=$_POST['email'];
				$website=$_POST['website'];

				
				$query=mysql_query("insert into tabel_profil 
									values('$nama_perusahaan','$gedung','$jalan','$kelurahan','$kecamatan','$propinsi','$negara','$telpon','$fax','$email','$website')");
				
				if($query){
					?><script language="javascript">document.location.href="?page=./setup/profil"</script><?php
				}else{
					echo mysql_error();
				}
			
			}else{
				unset($_POST['nama_perusahaan']);
			}
			
			?>
			
			</p>
	  </div>
	</div>
	</body>
	
<?php 
}else{
	echo "Forbidden Access!";
}
?>
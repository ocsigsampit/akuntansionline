<?php 
if (isset($_SESSION['id_admin']))
{
?>	
	<font color="#666666">
	<?php
	$query=mysql_query("SELECT * FROM tabel_profil");
	
	while($row=mysql_fetch_array($query)){
		echo "<h3>".strtoupper($row['nama_perusahaan'])."</h3>";
		echo "<br>";
		echo $row['jalan']." - ".$row['kelurahan'];
		echo "<br>";
		echo $row['kecamatan'];
		echo "<br>";
		echo $row['telpon'];
	}
	?>
	</font>
	
<?php 
}else{
	echo "Forbidden Access!";
}
?>

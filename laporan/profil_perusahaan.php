<?php 

if (isset($_SESSION['id_admin']))
{
?>	
	<font color="#666666">
	<?php
	$query=mysql_query("select * from tabel_profil");
	
	while($row=mysql_fetch_array($query)){
		echo strtoupper($row['nama_perusahaan']);
		echo "<br>";
		echo $row['jalan'];
	}
	?>
	</font>
	
<?php 
}else{
	echo "Forbidden Access!";
}
?>

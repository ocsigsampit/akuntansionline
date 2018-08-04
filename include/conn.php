<?php 
function open_connection(){

	//konfigurasi
	$host="localhost";
	$user="root";
	$pass="";
	$db="akuntansiku";
	
	
	//koneksi database
	$koneksi=mysql_connect($host,$user,$pass);
	mysql_select_db($db,$koneksi);
	
	return $koneksi;
}
?>

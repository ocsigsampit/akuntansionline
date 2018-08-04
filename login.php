<?php session_start();
ini_set('display_errors',FALSE);

//untuk koneksi
include "./include/conn.php";
$koneksi=open_connection();

//untuk koneksi
include "./encryption/function.php";

//untuk tanggal log
$waktu=date("Y-m-d H:i:s");

if(isset($_POST['username'])){

	$username=htmlentities((trim($_POST['username'])));
	$password=htmlentities(md5($_POST['password']));
	
	$login=mysql_query("select * from tabel_admin where username='$username' and password='$password'");
	
	$cek_login=mysql_num_rows($login);

		
	//untuk user biasa
	if (empty($cek_login))
	{
		?><script language="javascript">document.location.href="index.php?<?php echo paramEncrypt('status=error')?>";</script><?php 
	}else{
	
		//daftarkan ID jika user dan password BENAR
		while ($row=mysql_fetch_array($login))
		{
			$id_admin=$row['id_admin'];
			$nama=$row['nama'];
			$tanggal=$row['tanggal'];
			
			$_SESSION['id_admin']=$id_admin;
			$_SESSION['nama']=$nama;
			$_SESSION['tanggal']=$tanggal;
			
			mysql_query("update tabel_admin set tanggal='$waktu' where id_admin='$id_admin'");
		}
		
		?><script language="javascript">document.location.href="home.php";</script><?php 
	}
	

}else{
	unset($_POST['username']);
}
?>
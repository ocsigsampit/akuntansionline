<?php 

if (isset($_SESSION['id_admin']))
{
?>
	<p><span id="tick2" style="font-size: 18px;"></span></p>
	<div class="post">
		<div class="entry">
			<p align="center"><img src="images/logo.gif" width="538" height="200" alt="" /></p>
			<p align="center">&nbsp;</p>
			<p align="center"><font color="#666666">E-Accounting adalah sebuah Aplikasi akuntansi berbasis web yang digunakan untuk mengelola laporan keuangan sesuai 
			  dengan siklus akuntansi seperti Pencatatan, Penggolongan, Pengikhtisaran, dan Pelaporan.
			  </font>
		  </p>
		</div>
	</div>
	
	
	<div class="post">
		<div class="entry">
		<p align="center">
		<img src="images/siklus-akuntansi.jpg" border="0">
		</p>
	  </div>
	</div>

<?php 
}else{
	echo "Forbidden Access!";
}
?>
<?php 
if (isset($_SESSION['id_admin']))
{
?>
	<style type="text/css">
	body {
	 font-size:12px;	
	}
	#navbar {
		position:relative;
		background: url(nav.png) no-repeat;
		margin: 0 auto;
		width: 980px;
		height: 50px;
		clear: right;	
		z-index: 9999;
		}
	
	#nav {
		margin: 5px 0 0 51px;
		padding:0px; 
		position: relative;position:absolute; 
		display:block;}
	#nav > li { 
		list-style-type:none; 
		text-align:center;
		float:left; 
		display:block; 
		position:relative; 
		padding:0;
		margin: 0;
	
	}
	.smwid {width:110px;}
	.lrgwid { width:140px;}
	#nav > li a { 
		display:block; 
		padding:12px 20px;
		font-family:Arial, Helvetica, sans-serif;
		text-decoration: none;
		color:#666666;
		letter-spacing: 2px;
		font-size: 120%;
	}
	#nav > li:hover ul {
		display:block;
	}
	
	#nav > li a:hover {color: #543056; background-color: #f4f4f4; /* -moz-border-radius:5px; -webkit-border-radius:5px;*/ }
	
	#nav > ul li.smwid, 
	#nav > ul li.smwid a:hover {
			color: #543056; background-color: #f4f4f4 }
			
	#nav li ul { margin:0px; padding:0px; display:none; background-color:#f4f4f4; }
	.subsmwid {width:150px;}
	.sublrgwid { width:240px;}
	#nav li ul li { list-style-type:none; margin:0px; padding:0;}
	#nav li ul li a { 
		display:block; 
		padding:5px 5px 5px 8px; 
		color:#666666; 
		text-decoration:none; 
		letter-spacing: 1px;
		text-align:left;
		font-family: Helvetica Neue, Arial;
		font-size: 90%;
	}
	#nav li ul li:hover a { background-color:#e8e8e8;/* -moz-border-radius:5px; -webkit-border-radius:5px;*/}
	#nav > li a.sale {
			color: #ff0000;
		}	
	</style>
	
	<ul id="nav">
	
			<li class="smwid"><a href="?page=welcome">Home</a></li>			
			
			<li class="smwid"><span><a href="javascript:;">Setup</a></span>
				<ul class="subsmwid">						
				   <li><a href="?page=./setup/perkiraan" title="">Perkiraan</a></li>              			
				   <li><a href="?page=./setup/profil" title="">Profil</a></li>               			
				</ul>
			</li>			
			
			 <li  class="smwid"><a href="javascript:;">Transaksi</a>
				<ul class="subsmwid">						
					<li><a class="" href="?page=./transaksi/umum" title="">Jurnal Umum</a></li>						
					<li><a class="" href="?page=./transaksi/kas_keluar" title="">Jurnal Kas Keluar</a></li>	
					<li><a href="?page=./transaksi/posting" title="">Posting</a></li>  				
				</ul>
			</li>
			
			<li class="smwid"><a href="javascript:;">Laporan</a>
				<ul class="subsmwid">						
					<li><a class="" href="?page=./laporan/buku_jurnal" title="">Buku Jurnal</a></li>						
					<li><a class="" href="?page=./laporan/neraca_percobaan" title="">Neraca Percobaan</a></li>
					<li><a class="" href="?page=./laporan/hitung_shu" title="">Hitung SHU</a></li>
					<li><a class="" href="?page=./laporan/rugi_laba" title="">Rugi Laba</a></li>	
					<li><a class="" href="?page=./laporan/neraca" title="">Neraca</a></li>		
				</ul>
			</li>
			
			<li class="smwid"><a class="" href="?page=./laporan/backup_data" title="">Backup</a></li>
			
			
			<li class="smwid"><a href="logout.php" onclick="return confirm('Apakah Anda yakin?')">Logout</a>	
	</ul>
	
<?php 
}else{
	echo "Forbidden Access!";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>E-Accounting :: Login</title>
<link href="login-box.css" rel="stylesheet" type="text/css" />
</head>
<body onLoad="document.myform.elements['username'].focus();">
<div style="padding: 50px 100px 100px 400px;">
	<div id="login-box">
		<H2>Login</H2>
		<?php
		//untuk enkripsi
		//include "./encryption/function.php";
		
		//untuk mendecode url yang di enrypsi
		//$var=decode($_SERVER['REQUEST_URI']);
		
		//pecahkan nilai array
		
		if(isset($_GET['status'])){
			$status=$_GET['status'];
			switch($status){
				case "error";
					echo "Username atau password Anda salah!";
				break;
				
				case "logout";
					echo "Anda telah logout";
				break;
				
				case "forbidden";
					echo "Silahkan Anda login";
				break;
				
				default;
					echo "Selamat Datang di aplikasi web akuntansi online (E-Accounting)";
				break;
			}
		}
		
		?>
		<br />
		<br />
		<form action="login.php" method="post" name="myform">
		<div id="login-box-name" style="margin-top:20px;">Username:</div>
		<div id="login-box-field" style="margin-top:20px;"><input name="username" class="form-login" title="Username" value="" size="30" maxlength="2048" /></div>
		<div id="login-box-name">Password:</div><div id="login-box-field"><input name="password" type="password" class="form-login" title="Password" value="" size="30" maxlength="2048" /></div>
		<a href="javascript:;" onclick="document.myform.submit()">
		<img src="images/login-btn.png" width="103" height="42" style="margin-left:90px;" border="0"/>
		</a>	
		</form>
	</div>
</div>
</body>
</html>
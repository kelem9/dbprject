<?php
session_start();
include("ayar.php");

$kullanici = htmlentities(mysqli_real_escape_string($link,$_POST['kullanici']));

$kullanici_sor = mysqli_query($link,"SELECT * FROM admin WHERE isim='{$kullanici}'") or die (mysql_error());
$admin = mysqli_fetch_array($kullanici_sor,MYSQLI_BOTH);

if($_POST["kullanici"] == "" and $_POST["sifre"] == "")
{
echo "<center><font color=red>Hata!.. Kullanici adi veya Sifre yanlis.</font><S/center>";
header("Refresh: 2; url=index.php");
}else{

	if(isset($_POST["kullanici"]))
	{
		if (($_POST["kullanici"] == $admin['isim']) and ($_POST["sifre"] == $admin['sifre']))
		{
			$_SESSION["giris"] = "true";
			$_SESSION["isim"] = $_POST["kullanici"];
			$_SESSION["sifre"] = $_POST["sifre"];
			header("Location: panelim.php");
		exit;
		} else {
			echo "<center><font color=red>Hata!.. Kullanici adi veya Sifre yanlis.</font></center>";
			header("Refresh: 2; url=index.php");
		}
	}
}	
?>

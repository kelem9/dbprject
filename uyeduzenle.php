<?php

	if(!isset($_SESSION["giris"]))
	{
		echo '<font color="red">Bu sayfayi g�r�nt�leme yetkiniz yoktur.</font>';
		session_start();
		return;
	}
?>
<?php
include("ayar.php");

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sorgu = "SELECT * FROM admin WHERE id='$id'";
$admin_sorgu = mysqli_query($link,$sorgu) or die(mysql_error());
$uyeler = mysqli_fetch_array($admin_sorgu);

?>
<html>
<head>
<title>Y�netici Paneli</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="panelim.php?sayfa=UyeDuzenle" method="POST">

  <table width="225" border="0" align="center">
    <tr>
      <td width="219" bgcolor="#0099CC"><div align="center"><span class="menu">&Uuml;ye D&uuml;zenle </span></div></td>
    </tr>
  </table>
  <table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="f0f0f0">
<tr>
<td><span class="style4">Admin Ad&#305; </span></td>
<td>:</td>
<td><input type="text" name="user" value="<?php echo $uyeler['isim']; ?>"></td>
</tr>

<tr>
<td><strong class="style4">&#350;ifre</strong></td>
<td>:</td>
<td><input type="password" name="pass" value="<?php echo $uyeler['sifre']; ?>"></td>
<input name="id" type="hidden" id="id" value="<? echo $uyeler['id']; ?>">
</tr>

<tr>
<td></td>
<td></td>
<td><input name="buton" type="submit" class="style4" value="Kaydet" /></td>
</tr>
</table>

</form>
</body>
</html>
<?php 

$id = isset($_POST['id']) ? $_POST['id'] : '';
$isim = isset($_POST['user']) ? $_POST['user'] : '';
$sifre = isset($_POST['pass']) ? $_POST['pass'] : '';
$buton = isset($_POST['button']) ? $_POST['button'] : '';

if($buton){

$duzenle = mysqli_query($link,"UPDATE admin SET isim='$isim', sifre='$sifre' WHERE id='$id'");

	if($duzenle){

	echo "<center>�ye D�zenlendi</center>";

	header("Refresh: 2; url= panelim.php?sayfa=Uyeler");

	}else{

	echo "<center>�ye D�zenlenemedi</center>";

	header("Refresh: 2; url= panelim.php?sayfa=Uyeler");

	}

}
mysqli_close($link);	
		
?>
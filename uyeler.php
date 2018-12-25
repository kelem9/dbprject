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
	$sorgu = "SELECT * FROM admin ORDER BY id";
	$admin_sorgu = mysqli_query($link,$sorgu) or die(mysql_error());
?>
<html>
<head>
<title>Y�netici Paneli</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="303" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="f0f0f0">
  <tr>
    <td width="18" bgcolor="#0099CC" class="menu">ID</td>
    <td width="85" bgcolor="#0099CC" class="menu">Y&ouml;netici Ad&#305; </td>
    <td width="82" bgcolor="#0099CC" class="menu">&#350;ifre</td>
    <td width="56" bgcolor="#0099CC" class="menu">Sil</td>
    <td width="50" bgcolor="#0099CC" class="menu">D&uuml;zenle</td>
  </tr>
   <?php while ($uyeler = mysqli_fetch_array($admin_sorgu)){ ?>
 <tr>
    <td><?php echo $uyeler['id']; ?></td>
    <td><?php echo $uyeler['isim']; ?></td>
    <td><?php echo $uyeler['sifre']; ?></td>
    <td><a href="panelim.php?sayfa=UyeSil&id=<? echo $uyeler['id']; ?>">Sil</a></td>
    <td><a href="panelim.php?sayfa=UyeDuzenle&id=<? echo $uyeler['id']; ?>">D�zenle</a></td>
  </tr>
  <?php } ?>

<?php

$id = isset($_GET['id']) ? $_GET['id'] : '';

$sil = "DELETE FROM admin WHERE id = '$id'";
$sil_sonuc = mysqli_query($link,$sil);


?>
</table>
</body>
</html>
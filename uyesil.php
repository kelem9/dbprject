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

$sil = "DELETE FROM admin WHERE id='$id'";
$sil_sonuc = mysqli_query($link,$sil);

if($sil_sonuc){

echo "<center>�ye Silindi</center>";

header("Refresh: 2; url= panelim.php?sayfa=Uyeler");

}else{

echo "</center>�ye Silinemedi</center>";

header("Refresh: 2; url= panelim.php?sayfa=Uyeler");

}

mysqli_close($link);

?>

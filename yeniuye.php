<?php

  if(!isset($_SESSION["giris"]))
  {
    echo '<font color="red">Bu sayfayi g�r�nt�leme yetkiniz yoktur.</font>';
    session_start();
    return;
  }
?>

<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.style4 {font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; font-size: 12px; }
-->
</style>
<form action="panelim.php?sayfa=UyeEkle" method="POST">

  <table width="225" border="0" align="center">
    <tr>
      <td width="219" bgcolor="#0099CC"><div align="center"><span class="style1">Yeni Admin Kayd&#305; </span></div></td>
    </tr>
  </table>
  <table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="f0f0f0">
<tr>
<td><span class="style4">Admin Ad&#305; </span></td>
<td>:</td>
<td><input type="text" name="yeniuser"></td>
</tr>

<tr>
<td><strong class="style4">&#350;ifre</strong></td>
<td>:</td>
<td><input type="password" name="yenipass"></td>
</tr>

<tr>
<td></td>
<td></td>
<td><input name="buton" type="submit" class="style4" value="Kaydet" /></td>
</tr>
</table>

</form>


<?php 
include("ayar.php");

  $isim = isset($_POST['yeniuser']) ? $_POST['yeniuser'] : '';
  $sifre = isset($_POST['yenipass']) ? $_POST['yenipass'] : '';
  $buton = isset($_POST['buton']) ? $_POST['buton'] : '';

if($buton){

$ekle = "INSERT INTO admin (isim, sifre)values('$isim', '$sifre')";
$sonuc = mysqli_query($link,$ekle);

echo "<center>�ye Eklendi</center>";

header("Refresh: 2; url= panelim.php?sayfa=Uyeler");

}

mysqli_close($link);
?>

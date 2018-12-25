<?php
	session_start();
	if(!isset($_SESSION["giris"]))
	{
		echo '<font color="red">Bu sayfayi g�r�nt�leme yetkiniz yoktur.</font>';
		return;
	}
?>
<html>
<head>
<title>Y�netici Paneli</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="435" border="1" cellpadding="0" cellspacing="0" bordercolor="f0f0f0">
  <tr>
    <td width="120" height="226" align="left" valign="top"><table width="120" border="1" cellpadding="0" cellspacing="0" bordercolor="f0f0f0">
      <tr>
        <td width="115" bgcolor="#0099CC"><div align="center" class="menu">Men&uuml;</div></td>
      </tr>
    </table>
      <table width="120" border="1" cellpadding="0" cellspacing="0" bordercolor="f0f0f0">
        <tr>
          <td height="107" align="left" valign="top"><p class="style2">- <span class="style5"><a href="panelim.php" class="style2">Panelim</a></span><br />
            -------------------<span class="style1"><br />  
              <span class="style2">- </span></span><a href="panelim.php?sayfa=Uyeler" class="style2">&Uuml;yeler</a><span class="menu"><br />
              <span class="style2">-------------------</span><br />
                </span>-<span class="menu"><span class="style1"> <a href="panelim.php?sayfa=UyeEkle" class="style2">&Uuml;ye Ekle </a></span></span><br />
          -------------------<br />
          - <a href="panelim.php?sayfa=Cikis" class="style2">&Ccedil;&#305;k&#305;&#351;</a></p>
          </td>
        </tr>
    </table></td>
    <td width="309" align="left" valign="top">

	<?php 
	
	$sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : ''; 
	
	Switch($sayfa){
	
	case "Uyeler";
	
	include("uyeler.php");
	
	break;
	
	case "UyeEkle";
	
	include("yeniuye.php");
	
	break;
	
	case "UyeSil";
	
	include("uyesil.php");
	
	break;
	
	case "UyeDuzenle";
	
	include("uyeduzenle.php");
	
	break;
	
	case "Cikis";
	
	include("cikis.php");
	
	break;
	
	case "";
	
	echo "Panelinize Hos Geldiniz";
	
	break;
	
	}
	
	
	?></td>
  </tr>
</table>
</body>
</html>

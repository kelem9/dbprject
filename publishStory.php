<?php 
  session_start();
  if(!isset($_SESSION["giris"]))
  { 
      header("Location: social.php");
      return;
  }

  include("ayar.php");

  $sorgu = "SELECT * FROM person where email ='{$_SESSION["isim"]}'";
  $admin_sorgu = mysqli_query($link,$sorgu) or die(mysql_error());
  $uyeler = mysqli_fetch_array($admin_sorgu);
  $publishButon = isset($_POST['publishPost']) ? $_POST['publishPost'] : '';
  $inputTextContent = isset($_POST['inputTextContent']) ? $_POST['inputTextContent'] : '';
  $inputAlbumContent = isset($_POST['albumTittle']) ? $_POST['albumTittle'] : '';
  $ownerOfPost = $uyeler["userid"]; 
  if($publishButon){
    $ekle = "INSERT INTO story(userid, text_content)VALUES('$ownerOfPost','$inputTextContent');";
    $sonuc = mysqli_query($link,$ekle);
    $tempID = "SELECT S_DATE FROM story WHERE S_DATE=(SELECT MAX(S_DATE) FROM story);";
    $tempIDSonuc =  mysqli_query($link, $tempID);
    $tempLAST = mysqli_fetch_array($tempIDSonuc);
    if (is_uploaded_file($_FILES['inputimage']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['inputimage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['inputimage']['tmp_name']);
        $sql = "INSERT INTO media(userid,fs_path,type,profile_media)
            VALUES('$ownerOfPost','{$imgData}','{$imageProperties['mime']}','0')";
        $current_id = mysqli_query($link, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($link));
        $insertAlbumSql = "INSERT INTO album(userid,S_DATE,tittle,media_id) VALUES('$ownerOfPost','{$tempLAST[0]}','$inputAlbumContent',LAST_INSERT_ID())";
        $insertAlbumSql_sonuc = mysqli_query($link, $insertAlbumSql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($link));
        header("Refresh:0; url = social.php");
    }
    header("Refresh:0; url = social.php");
  }
   else {
    echo "<center>Eklenemedi !</center>";
    header("Refresh: 2; url= social.php");
   }

  mysqli_close($link);
  ?>

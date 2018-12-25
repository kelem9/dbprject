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
  $inputTextContent = isset($_POST['albumTittle']) ? $_POST['albumTittle'] : '';
  $addAlbumButton = isset($_POST['addAlbumButton']) ? $_POST['addAlbumButton'] : '';
  $ownerOfPost = $uyeler["userid"]; 

  if($addAlbumButton){
      if (is_uploaded_file($_FILES['inputimage']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['inputimage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['inputimage']['tmp_name']);
        $sql = "INSERT INTO media(userid,fs_path,type,profile_media)
            VALUES('$ownerOfPost','{$imgData}','{$imageProperties['mime']}','0')";
        $current_id = mysqli_query($link, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($link));
        $insertAlbumSql = "INSERT INTO album(userid,tittle,media_id) VALUES('$ownerOfPost','$inputTextContent',LAST_INSERT_ID())";
        $insertAlbumSql_sonuc = mysqli_query($link, $insertAlbumSql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($link));
        header("Refresh:0; url = social.php");
    }
  }
    
    /*
      if (is_uploaded_file($_FILES['inputimage']['tmp_name'])) {
        $imgData = addslashes(file_get_contents($_FILES['inputimage']['tmp_name']));
        $imageProperties = getimageSize($_FILES['inputimage']['tmp_name']);
        $sql = "INSERT INTO media(userid,fs_path,type,profile_media)
            VALUES('$ownerOfPost','{$imgData}','{$imageProperties['mime']}','0')";
        $current_id = mysqli_query($link, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
        if (isset($current_id)) {
            header("Location: social.php");
        }
    }
    $ekle = "INSERT INTO story(userid, text_content)VALUES('$ownerOfPost','$inputTextContent');";
    $sonuc = mysqli_query($link,$ekle);
    header("Refresh:0; url = social.php");
  }
   else {
    echo "<center>Eklenemedi !</center>";
    header("Refresh: 2; url= social.php");
   }
    */
  mysqli_close($link);
  ?>

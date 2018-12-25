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
  $inputTextContent = isset($_POST['inputTextContent']) ? $_POST['inputTextContent'] : '';
  $ownerOfPost = $uyeler["userid"]; 

  $deleteButton = isset($_POST['deleteStoryButton']) ? $_POST['deleteStoryButton'] : '';


  if($deleteButton) {
       $selectedValue = $_POST["selectedStory"];

       $mediaFound = "SELECT media_id from album where S_DATE='{$selectedValue}'";
       $mediFound_sonuc = mysqli_query($link,$mediaFound);
       $media = (mysqli_fetch_array($mediFound_sonuc));
        print_r($media);
       $commetDelete = "DELETE from Comment_of_person_to_story where S_DATE = '{$selectedValue}'";
       $commetDelete_sonuc = mysqli_query($link, $commetDelete);
       $albumDelete = "DELETE FROM album where S_DATE = '{$selectedValue}'";
       $albumDelete_sonuc =  mysqli_query($link, $albumDelete);
       $mediaDelete = "DELETE FROM media where id ='{$media['media_id']}'";
       $mediaDelete_sonuc = mysqli_query($link, $mediaDelete) or die(mysql_error());
       $strorySil = "DELETE FROM story WHERE S_DATE='{$selectedValue}'";
       $strorySil_sonuc = mysqli_query($link,$strorySil);
        header("Refresh: 0; url= social.php");
  }
 
  mysqli_close($link);
  ?>
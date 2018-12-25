<?php 
  session_start();
  if(!isset($_SESSION["giris"]))
  { 
      header("Location: social.php");
      return;
  }

  include("ayar.php");
  $sorgu = "SELECT * FROM person where email ='{$_SESSION["isim"]}'";
  $post_id = isset($_GET['postID']) ? $_GET['postID'] : ''; 
  $admin_sorgu = mysqli_query($link,$sorgu) or die(mysql_error());
  $uyeler = mysqli_fetch_array($admin_sorgu);
  $ownerOfPost = $uyeler["userid"]; 
  $inputComment = isset($_POST['inputComment']) ? $_POST['inputComment'] : '';

  $publishCommentButon = isset($_POST['publishComment']) ? $_POST['publishComment'] : '';
  if($publishCommentButon){
     $commentEkle = "INSERT INTO Comment_of_person_to_story(userid,S_DATE,text_content) VALUES ('$ownerOfPost','{$post_id}','$inputComment')  ";   
     $commentEkle_sorgu = mysqli_query($link,$commentEkle);
     header("Refresh: 0; url = /view.php?postID=$post_id");
  } 









  mysqli_close($link);

?>

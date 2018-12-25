<?php 
  include("ayar.php");

  $mail = isset($_POST['inputEmail']) ? $_POST['inputEmail'] : '';
  $inputUserName = isset($_POST['inputUserName']) ? $_POST['inputUserName'] : '';
  $inputPassword = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : ''; 
  $inputName = isset($_POST['inputName']) ? $_POST['inputName'] : '';
  $inputSurname = isset($_POST['inputSurname']) ? $_POST['inputSurname'] : ''; 
  $inputphone = isset($_POST['inputphone']) ? $_POST['inputphone'] : '';
  $buton = isset($_POST['button']) ? $_POST['button'] : '';
  $bDate = isset($_POST['bDate']) ? $_POST['bDate'] : '';


  if($buton){
    $ekle = "INSERT INTO person(username,S_PASSWORD, profile_name, birth_date, email,phone)VALUES('$inputUserName', '$inputPassword' ,'$inputName', '$bDate','$mail', '$inputphone');";
    $sonuc = mysqli_query($link,$ekle);
    header("Refresh:0; url = index.php");
  }
   else {
    echo "<center> $inputUserName </center>";
    echo "<center>Üye Eklenemedi !</center>";
    header("Refresh: 2; url= index.php");
   }

  mysqli_close($link);
  ?>


<?php  
        session_start();
        include("ayar.php");
        $message = "Lütfen Anasayfa dışından giriş yapmayınız !";
        $dynamiccolor = "red";
        if(array_key_exists('loginButton',$_POST) ) {
          $loginMail = isset($_POST['loginmail']) ? $_POST['loginmail'] : ''; 
          $loginPassword = isset($_POST['loginPassword']) ? $_POST['loginPassword'] : ''; 

          $kullanici = htmlentities(mysqli_real_escape_string($link,$loginMail));
  
          $kullanici_sor = mysqli_query($link,"SELECT * FROM person WHERE email='{$kullanici}'") or die (mysql_error());
          $user = mysqli_fetch_array($kullanici_sor,MYSQLI_BOTH);
          if($_POST['loginmail'] == "" and $_POST['loginPassword'] == "")
          {
              $dynamiccolor = "red";
              $message = "You entered wrong password or username. Please try again !";
              header("Refresh: 4; url=index.php");
          }else{
              if($_POST['loginmail'])
              {
                  if (($_POST['loginmail'] == $user['email']) and ($_POST['loginPassword']  == $user['S_PASSWORD']))
                  {
                    $dynamiccolor = "green";
                      $message = "Correct email and password. We are preparing your main page !";
                      $_SESSION["giris"] = "true";
                      $_SESSION["isim"] =  $_POST["loginmail"];
                      $_SESSION["sifre"] = $_POST["loginPassword"];                
                      header("Refresh: 3; url=social.php");
                  } else {
                      $dynamiccolor = "red";
                      $message = "You entered wrong password or username. Please try again !";
                      header("Refresh: 3; url=index.php");
                  }
              }
          }	
      mysqli_close($link);
    }
?>
 
<html>
    <head>
        <style>
            body{
                background-image: url("isometropolis.jpg");
            }
        </style>
        <title>Yönlendirliyorsunuz..</title>
        <link href="/public/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card text-center" style="margin-top:400px">
                    <div class="card-body">
                        <h5 class="card-title">Redirecting to Main Page !</h5>
                        <p class="card-text" style="color:<?php echo $dynamiccolor  ?>;">
                        <?php
                            echo $message
                        ?></p>
                    </div>
                    
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="loader">
                                <div class="loader-inner">
                                    <div class="loading one"></div>
                                </div>
                                <div class="loader-inner">
                                    <div class="loading two"></div>
                                </div>
                                <div class="loader-inner">
                                    <div class="loading three"></div>
                                </div>
                                <div class="loader-inner">
                                    <div class="loading four"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        

    </body>


</html>








<? ob_start(); ?> 
<?php
    session_start();
	if(!isset($_SESSION["giris"]))
	{ 
        header("Location: login.php");
		return;
    }
?>

<?php
    include("ayar.php");
    
    $sorgu = "SELECT * FROM person where email ='{$_SESSION["isim"]}'";
    $admin_sorgu = mysqli_query($link,$sorgu) or die(mysql_error());
    $uyeler = mysqli_fetch_array($admin_sorgu);

    $allUsersorgu = "SELECT * FROM person ORDER BY member_time desc";
    $allUser_sorgu = mysqli_query($link,$allUsersorgu) or die(mysql_error());

    $allPosts = "SELECT * FROM story ORDER BY s_date desc";
    $allPosts_sorgu = mysqli_query($link,$allPosts) or die(mysql_error());
    
    $ownerName = "SELECT *  from person p, story s where s.userid = p.userid order by s.s_date desc";
    $ownerName_sorgu = mysqli_query($link,$ownerName) or die(mysql_error());

    $countPerson = "SELECT count(userid) from person";
    $countPerson_sorgu = mysqli_query($link,$countPerson) or die(mysql_error());
?>

<html>
    <head>
    <meta charset="utf-8">
    <style>
        body{
            background-image: url("concrete-texture.png");
        }
    </style>
        <title>Social Page</title>
        <link href="style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>

    <body>     
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/index.php">ModeeSocial</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
                </ul>
                <span class="navbar-text">
                    Welcome, <?php echo $uyeler['username'] ?>
                </span>
                <form method="POST" class="form-inline my-2 my-lg-0">
                    <div class="col-auto">             
                        <input style="margin-top:5px;"type="submit" name="logOut" class="btn btn-sm btn-warning" value="Log out">
                    </div>     
                </form>
            </div>
        </nav>
        <div class="fluid-container">
        <div class="row">
            <div class="col-md-3">
                
            </div>
            <div class="col-md-6">
                <img src="240_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg" alt="..." class="w-25 p-3 rounded-circle " style=" display: block; margin-left: auto;margin-right: auto; width: 50%; margin-top:10%;">
                <h3 style="text-align:center; font-family: 'Staatliches', cursive;"><?php echo $uyeler['profile_name'] ?></h3>  
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a href="/social.php" style="display: block; margin-left: auto;margin-right: auto;margin-top:14px; color:black; font-size:50px;"><i class="fas fa-arrow-left"></i></a>
                    </li>
                </ul>
                <hr>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST">
                        <div class="input-group mb-3" style="margin-top: 50px; width:500; margin-left: auto;margin-right: auto; ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input name="updateUsername" type="text" class="form-control" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $uyeler["username"] ?>" required> 
                        </div>
                        <div class="input-group mb-3" style="width:500; margin-left: auto;margin-right: auto; ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input name="updateEmail" type="text" class="form-control" aria-label="email" aria-describedby="basic-addon1" value="<?php echo $uyeler["email"] ?>" required>
                        </div>
                        <div class="input-group mb-3" style="width:500; margin-left: auto;margin-right: auto; ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                            </div>
                            <input name="updatePassword" type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="input-group mb-3" style="width:500; margin-left: auto;margin-right: auto; ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-file-signature"></i></span>
                            </div>
                            <input name="updateprofile_name" type="text" class="form-control" placeholder="Profile Name" aria-label="profile_name" value="<?php echo $uyeler["profile_name"] ?>" aria-describedby="basic-addon1" required>
                        </div>
                        <div class="input-group mb-3" style="width:500; margin-left: auto;margin-right: auto; ">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                            </div>
                            <input name="updatePhone" type="text" class="form-control" placeholder="Phone" aria-label="phone" aria-describedby="basic-addon1" value="<?php echo $uyeler["phone"] ?>">
                        </div>
                        <input name="updateButton" class="btn btn-primary mb-2"  style="display: block; margin-left: auto;margin-right: auto; width: 50%" type="submit" value = "Update" required>
                        <input name="deleteButton" class="btn btn-primary mb-2 btn-danger"  style="display: block; margin-left: auto;margin-right: auto; width: 50%" type="submit" value = "Delete My Account">
                    </div>
                </div>
            </form>
        </div>
     
    </body>
</html>

<?php

if(array_key_exists('logOut',$_POST) ) {
    session_destroy();
    header("Location: index.php");
}
?>

<?php 
    include("ayar.php");

    $updateUsername = isset($_POST['updateUsername']) ? $_POST['updateUsername'] : '';
    $updateEmail = isset($_POST['updateEmail']) ? $_POST['updateEmail'] : '';
    $updatePassword = isset($_POST['updatePassword']) ? $_POST['updatePassword'] : ''; 
    $updateprofile_name = isset($_POST['updateprofile_name']) ? $_POST['updateprofile_name'] : '';
    $updatePhone = isset($_POST['updatePhone']) ? $_POST['updatePhone'] : '';
    $updateButton = isset($_POST['updateButton']) ? $_POST['updateButton'] : '';
    $deleteButton = isset($_POST['deleteButton']) ? $_POST['deleteButton'] : '';

    if($updateButton){
        $update = "UPDATE person SET username = '$updateUsername', S_PASSWORD= '$updatePassword', profile_name = '$updateprofile_name', email='$updateEmail', phone = '$updatePhone' WHERE userid = '{$uyeler["userid"]}'";
        $update_sorgu = mysqli_query($link,$update);
        header("Location: index.php");
      }
    if($deleteButton) {
        $siluser_story = "DELETE FROM story WHERE userid='{$uyeler["userid"]}'";
        $siluser_story_sonuc = mysqli_query($link,$siluser_story);
        $sil_user = "DELETE FROM person WHERE userid='{$uyeler["userid"]}'";
        $siluser_sonuc = mysqli_query($link,$sil_user);
        header("Location: index.php");
    }
      mysqli_close($link);


?>
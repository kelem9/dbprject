
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

    $getFile = "SELECT m.fs_path FROM media m, story s, album a WHERE s.S_DATE = a.S_DATE and a.media_id = m.id order by s.s_date desc";
    $result = mysqli_query($link, $getFile) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($link));

    $userPosts = "SELECT * FROM story s, person p  where  s.userid = p.userid and p.userid = '{$uyeler["userid"]}' ORDER BY s_date desc";
    $userPosts_sorgu = mysqli_query($link,$userPosts) or die(mysql_error());

    $allAlbums = "SELECT * FROM album a, person p where a.userid = p.userid and p.userid = '{$uyeler["userid"]}'";
    $allAlbums_sorgu = mysqli_query($link,$allAlbums) or die(mysql_error());

    $allAlbums_ = "SELECT * FROM album a, person p where a.userid = p.userid and p.userid = '{$uyeler["userid"]}'";
    $allAlbums_sorgu_ = mysqli_query($link,$allAlbums_) or die(mysql_error());
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
        <link href="/public/css/style.css" rel="stylesheet" type="text/css" />
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
                    <li class="nav-item active">
                        <a class="nav-link" href="/index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <i class="fa fa-user"></i> Welcome, <?php echo ($uyeler['username']) ?>
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
                <button type="button" class="btn btn-primary" style="margin-top: 350px; display: block; margin-left: auto;margin-right: auto; width: 50%">
                    Online <span class="badge badge-light">1</span>
                </button>
                <ul class="list-group" style="max-height:400px; width:200px; display: block; margin-left: auto;margin-right: auto; width: 50%;">
                    <li class="list-group-item"><?php echo $uyeler['profile_name'] ?></li>
                </ul>
                <hr style="display: block; margin-left: auto;margin-right: auto; width: 50%;">
                <button type="button" class="btn btn-dark disabled" style=" margin-top:30px;display: block; margin-left: auto;margin-right: auto; width: 50%">
                        Albums
                </button>
                <ul class="list-group" style="max-height:400px; width:200px; display: block; margin-left: auto;margin-right: auto; width: 50%;">
                    <?php while ($allAlbums__ = mysqli_fetch_array($allAlbums_sorgu_)){ ?>
                        <li class="list-group-item"><?php echo $allAlbums__ ["tittle"]?></li>
                    <?php } ?>
                </ul>
                <hr style="display: block; margin-left: auto;margin-right: auto; width: 50%;">
            </div>
            <div class="col-md-6">
                <img src="240_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg" alt="..." class="w-25 p-3 rounded-circle " style=" display: block; margin-left: auto;margin-right: auto; width: 50%; margin-top:10%;">
                <h3 style="text-align:center; font-family: 'Staatliches', cursive;"><?php echo $uyeler['profile_name'] ?></h3>  
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a style = "font-family: 'Staatliches', cursive; font-size:20px; color:black;" class="nav-link active" href="#">Homepage</a>
                    </li>
                    <li class="nav-item">
                        <a style = "font-family: 'Staatliches', cursive; font-size:20px; color:black;" class="nav-link" href="/editData.php">My PROFILE</a>
                    </li>
                    <li class="nav-item">
                        <a style = "font-family: 'Staatliches', cursive; font-size:20px; color:black;" class="nav-link" href="#">FRIENDS</a>
                    </li>
                    <li class="nav-item">
                        <a style = "font-family: 'Staatliches', cursive; font-size:20px; color:black;" class="nav-link" name="logOutLink" href="">LOGOUT</a>
                    </li>
                </ul>
                <hr>
                    <form action="publishStory.php" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            <input  type="text-area" name="inputTextContent" style= "height:50px; width: 20px;"class="form-control" aria-label="With textarea" placeholder="Publish your ideas with your friends!"> 
                            <div class="input-group-append" id="button-addon4">
                                <input class="btn btn-outline-secondary" type="submit" name="publishPost" value = "Publish">
                            </div>
                        </div>
                        <div class="form-check form-check-inline" style="margin-top: 10px;">
                            <input required type="text" class="form-control p-3" name="albumTittle" style="display: block; margin-left: 5px; margin-top:1%; width:560px;" placeholder="Album Name" >
                            <input type="file" name="inputimage" style="margin-left: 10px; margin-top:1%;">
                        </div>    
                    </form>
                   
                    <?php while ($allPosts = mysqli_fetch_array($allPosts_sorgu)){ ?>
                        <?php $newUsers = mysqli_fetch_array($ownerName_sorgu); ?>
                        <?php $row = mysqli_fetch_array($result); ?>
                        <div class="card shadow" style="margin-top: 20px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4" style="height: 200px; ">
                                        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['fs_path'] ).'" style = "height: 200px; width:200px;"/>'; ?>
                                    </div>
                                    <div class="col-md-8">
                                        <p class="card-text"><?php echo $allPosts['text_content'] ?></p>
                                        <hr>
                                        <p class="card-text"><small class="text-muted">-<b><?php echo $newUsers["profile_name"] ?></b></small></p>
                                        <p class="card-text"><small class="text-muted"><?php echo $allPosts['S_DATE'] ?></small></p> 
                                        <a href="" style="color:black; font-size:25px;"><i class="far fa-thumbs-up"></i></a>
                                        <a href="/view.php?postID=<?php echo $allPosts['S_DATE'] ?>" style="color:black;font-size:25px; margin-left:10px;" ><i class="fas fa-comments"></i></a>
                                        <a href="" style="color:black;font-size:25px; margin-left:10px;"><i class="fas fa-share-alt"></i></a>
                                        
                                        
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
            </div>
            <div class="col-md-3">  
                <div>
                    <?php $personCounter = mysqli_fetch_array($countPerson_sorgu); ?>
                    <button type="button" class="btn btn-primary" style="margin-top: 350px; display: block; margin-left: auto;margin-right: auto; width: 50%">
                        Registered Person <span class="badge badge-light"><?php echo $personCounter[0]?></span>
                    </button>
                    <ul class="list-group" style="max-height:400px; width:200px; display: block; margin-left: auto;margin-right: auto; width: 50%;">
                        <?php while ($newUsers = mysqli_fetch_array($allUser_sorgu)){ ?>
                            <li class="list-group-item"><?php echo $newUsers['profile_name'] ?></li>
                        <?php } ?>
                    </ul>
                    <hr style="display: block; margin-left: auto;margin-right: auto; width: 50%;">
                    <button type="button" class="btn btn-danger disabled" style=" margin-top:30px;display: block; margin-left: auto;margin-right: auto; width: 50%">
                        Delete Story
                    </button>
                        <form action="deleteStory.php" method="POST" class="form-inline" style="margin-top: 10px;display: block; margin-left: auto;margin-right: auto; width: 50%" >
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="selectedStory">
                                <option selected>Choose...</option>
                                <?php while ($userPost_ = mysqli_fetch_array($userPosts_sorgu)){ ?>
                                    <option value="<?php echo $userPost_["S_DATE"]?>"><?php echo $userPost_["text_content"]?></option>
                                <?php } ?>
                            </select>
                            <input type="submit" name="deleteStoryButton" class="btn btn-danger my-1" value="Delete">
                        </form>
                </div>
            </div>
        </div>
    </div>                     
</body>
</html>
<?php
    if(array_key_exists('logOut',$_POST) ) {
        session_destroy();
        header("Location: index.php");
    }
?>
<? ob_flush(); ?> 
<?php
    session_start();
	if(!isset($_SESSION["giris"]))
	{ 
        header("Location: index.php");
		return;
    }
?>

<?php 
    include("ayar.php");
    $sorgu = "SELECT * FROM person where email ='{$_SESSION["isim"]}'";
    $admin_sorgu = mysqli_query($link,$sorgu) or die(mysql_error());
    $uyeler = mysqli_fetch_array($admin_sorgu);
    $post_id = isset($_GET['postID']) ? $_GET['postID'] : ''; 
    $getFile = "SELECT fs_path from album a, media m where m.id = a.media_id and a.S_DATE = '{$post_id}'";
    $getFile_sorgu = mysqli_query($link, $getFile) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($link));
    $requstedImage = mysqli_fetch_array($getFile_sorgu);

    $getTextContent = "SELECT text_content from story where S_DATE = '{$post_id}'";
    $getTextContent_sorgu = mysqli_query($link, $getTextContent) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($link));
    $requstedText = mysqli_fetch_array($getTextContent_sorgu);

    $getComments = "SELECT * from Comment_of_person_to_story c, person p where S_DATE = '{$post_id}' and c.userid = p.userid ORDER BY c.posted_time desc";
    $getComments_sorgu = mysqli_query($link, $getComments) or die("<b>Error:</b> Problem on Retrieving Comemnts BLOB<br/>" . mysqli_error($link));

    $countComments = "SELECT count(*) from Comment_of_person_to_story  where S_DATE = '{$post_id}'";
    $countComments_sorgu =  mysqli_query($link, $countComments) or die("<b>Error:</b> Problem on Retrieving Comemnts BLOB<br/>" . mysqli_error($link));
    $countString = mysqli_fetch_array($countComments_sorgu);
?>

    <html>
        <head>
            <title>POST Page</title>
            <link href="/public/css/style.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
            <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <link href="https://fonts.googleapis.com/css?family=Staatliches" rel="stylesheet">
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <meta charset="utf-8">
           
        </head>
        <body>
            <style>
                body{
                    background-image: url("../concrete-texture.png");
                }
            </style>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/index.php">ModeeSocial</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="/social.php">Social Page <span class="sr-only">(current)</span></a>
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
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="/social.php" style="display: block; margin-left: auto;margin-right: auto;margin-top:100px; color:black; font-size:50px;"><i class="fas fa-arrow-left"></i></a>
                </li>
            </ul>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3 shadow" style="margin-top:50px;">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $requstedImage['fs_path'] ).'""/>'; ?>
                            <div class="card-body">
                                <p class="card-text"><?php echo $requstedText[0]  ?></p>
                                <p class="card-text"><small class="text-muted"><?php echo $post_id ?></small></p>
                                <a href="" style="color:black; font-size:25px;"><i class="far fa-thumbs-up"></i></a>
                                <a href="" style="color:black;font-size:25px; margin-left:10px;"><i class="fas fa-share-alt"></i></a>
                            </div>
                        </div>
                    </div>        
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" class="btn btn-primary">
                                Comments <span class="badge badge-light"><?php echo  $countString[0] ?></span>
                                <span class="sr-only">unread messages</span>
                            </button>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                        <a id="addacomment" class="btn btn-primary" style="float:right; color: white;">Add a comment</a> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="addcomment" style="display: none; width:100%; margin-top: 50px;">
                                    <form action="makeComment.php?postID=<?php echo $post_id ?>"  method= "POST">
                                        <textarea name = "inputComment" class="form-control" placeholder="Your comment ..."></textarea><br/>
                                        <input name ="publishComment" type="submit" class="btn btn-primary" value="Send">
                                    </form>
                            </div>
                        </div>
                    </div>                  
                    <hr>
                    <?php while($AllComments_ = mysqli_fetch_array($getComments_sorgu)){ ?>
                    <div class="row comment">
                        <div class="head">
                            <small><strong class='user' style="margin-left:20px;"><?php echo $AllComments_["profile_name"] ?></strong><?php echo $AllComments_["posted_time"] ?></small>
                            <p style="margin-left:30px;"><?php echo $AllComments_["text_content"]?> </p>
                        </div>
                    </div>
                    <hr>
                    <?php } ?>
                    
                </div>
            </div>
            <script>
                $(document).on('click', '#addacomment', function(){
                    $('#addcomment').toggle();
                });
            </script>
        </body>

      


    </html>
   



    <?php
            if(array_key_exists('logOut',$_POST) ) {
                session_destroy();
                header("Location: index.php");
            }
        ?>        












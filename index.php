<?php

?>
<html>
<head>

<style>
  body{
	  background-image: url("isometropolis.jpg");
  }
</style>
    <title>Homepage</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
        <form action="/login.php" method="POST" class="form-inline my-2 my-lg-0">
          <div class="form-row align-items-center">
            <div class="col-auto">
              <input type="text" class="form-control mb-2" id="inlineFormInput" name="loginmail" placeholder="Mail">
            </div>
            <div class="col-auto">
              <div class="input-group mb-2">
                <input type="password" class="form-control" id="inlineFormInputGroup" name="loginPassword" placeholder="Password">
              </div>
            </div>
            <div class="col-auto">
            </div>
            <div class="col-auto">
              <input type="submit" name="loginButton" class="btn btn-primary mb-2" value="Login">
            </div>
          </div>
        </form>
        </form>
      </div>
    </nav>
      <div class="row">
        <div class="col-md-4">
          
        </div>
        <div class="col-md-8">
          <div class="jumbotron" style="height: 500px; margin-top:150px;">
              <h1 class="display-4">Welcome to our social world!</h1>
              <p class="lead">Connect and share with the people in your life !</p>
              <hr class="my-4">
                <div class="row">
                  <div class="col-md-6">
                  <form action="kayıt.php" style="float:left;" method="POST" style="float:left;">
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" style="width:400px;" name="inputEmail" placeholder="Email" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="username" class="form-control" style="width:400px;" name="inputUserName" placeholder="Username" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" style="width:400px;" name="inputPassword" placeholder="Password" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Birthdate</label>
                        <div class="col-sm-10">
                          <div class="form-group">
                                <input type="text" name ="bDate" id="datepicker"  style="width:400px;" class="form-control" placeholder="Choose">
                          </div>
                        </div>
                      </div>
                  </div>           
                  <div class="col-md-6">
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Name:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" style="width:400px;" name="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Surname:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" style="width:400px;" name="inputSurname" placeholder="Surname">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" style="width:400px;" name="inputphone" placeholder="Phone Number" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <input name="button" type="submit" class="btn btn-primary" value="Sign Up"> 
                        </div>
                      </div>
                  </form>
                </div>                  
              </div>
          </div>  
        </div>
      </div>
    <div>
    <script>
      $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat : 'yy/mm/dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
    </script>
    
</body>
</html>
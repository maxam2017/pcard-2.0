<?php
require_once 'db_config.php';

if($user->is_loggedin()!=""){
 $user->redirect('index.php');
}

if(isset($_POST['submit'])){
 $username = $_POST['username'];
 $passwd = $_POST['passwd'];
  
 if($user->login($username,$passwd)){
  $user->redirect('index.php');
 }
 else{
  $error[] = "Wrong Details !";
 } 
}
?>

<!DOCTYPE html>
<html lang="zh-tw">
<?php require('_head.php')?>
<head>
    <link rel="stylesheet" href="asset/css/regi.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>

<body>

<?php require('header.php');?>
    <div id="container2">
                      <fieldset><legend><h3>Pcard登入</h3></legend></fieldset>
<?php
if(isset($error)){
   foreach($error as $error){
?>
      <div class="alert alert-danger alert-dismissible fade show ">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="height:100%;">
        <span aria-hidden="true">&times;</span>
        </button><?php echo $error; ?></div>
      <?php
   }
}
?>
<hr>
            <form action="login.php" method="post" enctype="multipart/form-data">
  <div class="form-group row ">
    <label class="col-sm-2 col-form-label">帳號</label>
    <div class="col-sm-10">
      <input  class="form-control" name="username" placeholder="Username" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">密碼</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="passwd" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
    <a class="btn btn-secondary" href="" style=" pointer-events:none;">忘記密碼</a>
    <button type="submit" name="submit" class="btn btn-primary mx-2">登 入</button>
    </div>
  </div>
</form>
  <hr>
<div class="fb-login-button my-4" scope="public_profile email" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true" onlogin="checkLoginState();" onclick="FB.login()"></div>
        </div>
        <script src="asset/js/main.js"></script>
</body>

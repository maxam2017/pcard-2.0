<?php
$tag = false;
require_once 'db_config.php';
require_once '_head.php';
if($user->is_loggedin()!="")
{
    $user->redirect('index.php');
}
if(isset($_POST['submit'])){
   $username = trim($_POST['username']);
   $passwd = trim($_POST['passwd']);
   $name = trim($_POST['nickname']);
   $email = trim($_POST['email']);
   $school = trim($_POST['school']);
   $gender = trim($_POST['gender']);
 
   if($username=="") {
      $error[] = "provide username !"; 
   }
   else if($email=="") {
      $error[] = "provide email!"; 
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = 'Please enter a valid email address !';
   }
   else if($passwd=="") {
      $error[] = "provide password !";
   }
   else if(strlen($passwd) < 6){
      $error[] = "Password must be atleast 6 characters"; 
   }
   else{
      try
      {
         $stmt = $DB_con->prepare("SELECT username,email FROM user WHERE username=:username OR email=:email");
         $stmt->execute(array(':username'=>$username, ':email'=>$email));
         $row=$stmt->fetch(PDO::FETCH_ASSOC);
    
         if($row['username']==$username) {
            $error[] = "sorry username already taken !";
         }
         else if($row['email']==$email) {
            $error[] = "sorry email id already taken !";
         }
         else{
            if($user->register($username,$passwd,$name,$email,$school,$gender)) {
//                $user->redirect('regist.php?joined');
                  $tag = true;
            }
         }
     }
     catch(PDOException $e){
        echo $e->getMessage();
     }
  } 
}
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<link href="asset/css/regi.css" rel="stylesheet">
</head>
<body>
<?php require_once 'header.php';?>
    <div id="container2">
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
if($tag == true){
     ?>
    <div class="alert alert-success alert-dismissible fade show " >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="height:100%;">
        <span aria-hidden="true">&times;</span>
        </button>註冊成功</div>
<?php
}
?>
           <fieldset><legend><h3>註冊Pcard帳號</h3></legend></fieldset>
<hr>
            <form action="regist.php" method="post" enctype="multipart/form-data">
  <div class="form-group row ">
    <label class="col-sm-2 col-form-label">帳號</label>
    <div class="col-sm-10">
      <input  class="form-control" name="username" placeholder="Username" value="<?php if(isset($error)){echo $username;}?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">密碼</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="passwd" placeholder="Password" value="<?php if(isset($error)){echo $passwd;}?>" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">暱稱</label>
    <div class="col-sm-10">
      <input  class="form-control" name="nickname" placeholder="Nickname" value="<?php if(isset($error)){echo $name;}?>" required>
    </div>
  </div>
       <div class="form-group row">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($error)){echo $email;}?>" required>
    </div>
  </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">學校</label>
    <div class="col-sm-10">
      <input  class="form-control" name="school" placeholder="School" value="<?php if(isset($error)){echo $school;}?>" required>
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-legend col-sm-2">性別</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" id="gender1" value="m" checked>
            男生
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" id="gender2" value="f">
            女生
          </label>
        </div>
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" id="gender3" value="x">
            不告訴你
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <hr>
  <div class="form-group row">
    <div class="col-sm-10">
      <div class="form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" required>資料是否填寫正確
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
     <a class="btn btn-secondary" href="index.php">返回</a>
    <button type="submit" name="submit" class="btn btn-primary mx-2">註 冊</button>
    </div>
  </div>
</form>
        </div>
        <script src="asset/js/main.js"></script>
</body>

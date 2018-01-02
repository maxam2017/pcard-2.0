<?php
require_once 'db_config.php';
require '_head.php';

if(isset($_POST['submit'])){
  $title = trim($_POST['title']);
  $content = trim($_POST['content']);
  $user->post($title,$content,$_SESSION['user_session']);
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
<?php require 'header.php';?>
    <div id="container2">
<?php
if(isset($_POST['submit'])){
?>
    <div class="alert alert-success alert-dismissible fade show " >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="height:100%;">
        <span aria-hidden="true">&times;</span>
        </button>發佈成功</div>
<?php
}
?>
           <fieldset><legend><h3>寫下你的心情</h3></legend></fieldset>
<hr>
            <form action="create.php" method="post" enctype="multipart/form-data">
  <div class="form-group row ">
    <label class="col-sm-2 col-form-label">標題</label>
    <div class="col-sm-10">
      <input  class="form-control" name="title" placeholder="Title" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">內容</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="content" placeholder="最多輸入8000字" rows="12" required></textarea>
    </div>
  </div>
  <hr>
  <div class="form-group row">
    <div class="col-sm-10">
      <div class="form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" required>確認是否發文 
        </label>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
     <a class="btn btn-secondary" href="index.php">返回</a>
    <button type="submit" name="submit" class="btn btn-primary mx-2">發佈貼文</button>
    </div>
  </div>
</form>
        </div>
        <script src="asset/js/main.js"></script>
</body>


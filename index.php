<?php
require('_head.php');
if(isset($_GET['logout'])){
  
  $user->logout();
}
?>
<body>
    <?php
      require('header.php');
      require('nav.php'); 
    ?>
    <div id="container">
        <div id="result"></div>
    </div>
    <div id="top"><img src="asset/img/icon/top.svg"></div>
<?php require('footer.php');?>
    <script src="asset/js/main.js"></script>
</body>

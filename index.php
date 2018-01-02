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
    <footer>Copyright &copy; 2017 MAXAM - all rights reserved -</footer>
    <script src="asset/js/main.js"></script>
</body>

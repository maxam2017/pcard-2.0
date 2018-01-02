<header>
        <a href="https://people.cs.nctu.edu.tw/~hkwu0313/final/">
           <div id="logo-container">
            <img src="asset/img/logo.png" width="85%" id="logo">
            </div>
        </a>
        <div id="search">
            <input type="text" placeholder="搜尋文章" id="search_box">
            <img src="asset/img/icon/search.svg" alt="" id="search_icon">
        </div>
        <div id="ham">
            <div id="rect1"></div>
            <div id="rect2"></div>
            <div id="rect3"></div>
        </div>
        <div id="user">
<?php
if($user->is_loggedin()!=""){
?>
  <a href="create" class="link" id="create">新增留言</a>
  <a href="index.php?logout" class="link" id="logout">登出</a>
<?php
}
else{
?> 
  <a href="regist" class="link" id="regi">註冊</a>
  <a href="login" class="link" id="login">登入</a>
<?php
}
?>
        </div>
    </header>

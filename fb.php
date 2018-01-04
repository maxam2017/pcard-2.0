<?php
require_once 'db_config.php';

if(!empty($_POST)){
  $username = trim($_POST['id']);
  $passwd = 'foo'.$_POST['id'].'bar';
  $name = trim($_POST['name']);
  $school = '';
  $email = trim($_POST['email']);
  $gender = trim($_POST['gender']);
  if($_POST['gender']=='male'){
    $gender = 'm';
  }
  else if($_POST['gender']=='female'){
    $gender = 'f';
  }
  else{
    $gender = 'x';
  }
  echo $username;
  echo $passwd;
  echo $name;
  echo $school;
  echo $email;
  echo $gender;
  try{
    $stmt = $DB_con->prepare("SELECT username,email FROM user WHERE username=:username OR email=:email");
    $stmt->execute(array(':username'=>$username, ':email'=>$email));
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    if($row['username']==$username && $row['email']==$email) {
      $user->login($username,$passwd);
    }
    else{
      if($user->register($username,$passwd,$name,$email,$school,$gender)) {
        $user->login($username,$passwd);
      }
    }    
    $user->fb_connect = true;
  }
  catch(PDOException $e){
    echo $e->getMessage();
  }
}
?>

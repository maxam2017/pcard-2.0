<?php
require_once 'db_config.php';
require '_head.php';

$id = $_GET['id'];

$sql = 'SELECT user_id FROM post where id='.$id;
$q = $DB_con->prepare($sql);
$q->execute();
if($q[0]['user_id']==$_SESSION['user_session']){  
  $sql = 'DELETE * FROM post where id='.$id;
  $q = $DB_con->prepare($sql);
  $q->execute();
}
?>

<?php
class USER
{
  private $db;
  function __construct($DB_con){
    $this->db = $DB_con;
  }
  public function register($username,$passwd,$nickname,$email,$school,$gender){
    try{
      $new_password = password_hash($passwd, PASSWORD_DEFAULT);
      $sql="INSERT INTO user (username,passwd,nickname,email,school,gender) VALUES (?,?,?,?,?,?)";
      $stmt = $this->db->prepare($sql);   
      $stmt->execute(array($username,$new_password,$nickname,$email,$school,$gender)); 
      return $stmt; 
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }    
  }
  public function login($username,$passwd){
    try{
      $stmt = $this->db->prepare("SELECT * FROM user WHERE username='".$username."' LIMIT 1");
      $stmt->execute();
      $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
      if($stmt->rowCount() > 0){
        if(password_verify($passwd, $userRow['passwd'])){
          $_SESSION['user_session'] = $userRow['id'];
          return true;
        }
        else{
          return false;
        }
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  }
  public function post($title,$content,$id){
    try{
      $sql="INSERT INTO post (title,content,user_id) VALUES (?,?,?)";
      $stmt = $this->db->prepare($sql);
      $stmt->execute(array($title,$content,$id)); 
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  } 

  public function is_loggedin(){
    if(isset($_SESSION['user_session'])){
      return true;
    }
  }
  public function redirect($url){
    header("Location: $url");
  }
  public function logout(){
    session_destroy();
    unset($_SESSION['user_session']);
    return true;
  }
}
?>

<?php
    require_once 'db_config.php';
    header('Content-type:application/json;charset=utf-8'); 
if($_SERVER['REQUEST_METHOD']=='GET'){
        if($_SERVER['REQUEST_URI']=='/~hkwu0313/final/post'){
          $sql = 'select * from post order by id desc';
        }
        else{
          $para =  explode('/', $_SERVER['PATH_INFO']);
           $id = $para[1];
          if($id == ''){
            $sql = 'select * from post order by id desc';
          }
          else{
            //for search specific id
            $sql = 'select * from post where user_id='.$id.' order by id desc';
          }
        }
        $q = $DB_con->prepare($sql);
        $q->execute();
        foreach($q as $row){
          //return row format example: 'id':'1','0':'1','title':'hello','1':'hello'....
          //so we need to slice array retriving the odd part.
          foreach ($row as $k => $v) {
              if (strlen($k)>1) 
                    $da[$k] = $v;
          }
          $data[] = $da;
        }
        if($data==null){
          $data=[];
        }
        echo json_encode($data);
    }
    else{
        
    }
?>

<?php 
session_start();
 require('./database.php');
 $pwd = $_SESSION['password'];

if(isset($_GET['submit_faculty'])){
  $name = $_SESSION['name'] ;
   $class  = $_GET['unit_class'];
   $no_units = $_GET['number_of_units'];
   $office = $_GET['office'];
   $purpose = $_GET['purpose'];

   if($class == 'Other'){
    $class = $_GET['other_unit_class'];
   }
   if($office  =='Other'){
     $office = $_GET['other_office'];
   }
 
   $sql = " INSERT into unit_request (classification,no_units,request_by,office,purpose,date_time_requested)values('$class' ,$no_units, '$name','$office', '$purpose',now())";
   $sqlquery = mysqli_query($sqlconnect,$sql);
   if($sqlquery){
    $_SESSION['status'] ="Request Form Submit  Success!";
      header('location: faculty.php');
   }
  
  }
  if(isset($_GET['report'])){
     $name = $_GET['name'];
     $class = $_GET['class'];
     $lab = $_GET['lab'];
     $no= $_GET['pc_unit'];
     $prob = $_GET['prob'];
    
    $sql = " INSERT into unit_reports (classification,unit_code,problem,date_report,reported_by)
    VALUES('$class',(SELECT concat(code,'-','$lab','-','$no') from inventory where No = $no ),'$prob',now(),'$name');";
    $sqlquery = mysqli_query($sqlconnect,$sql);
    if($sqlquery) {
      $_SESSION['status'] ="Report Form Submit  Success!";
      header('location: equipreport.php');
    }
     
  }
  if(isset($_GET['Xamp'])){
    foreach($_GET['range'] as $select){
      echo $select;
    }
    echo $_GET['name'];
  
   
   
  }

  if(isset($_GET['submit_request'])){
    $lab = $_GET['lab'];
    $name = $_GET['name'];
    $id=  $_GET['id'];
    $class = $_GET['class'];
    $remark = $_GET['remark'];
    $pass = $_GET['pass'];
    if(empty($_GET['range'])){
      if($pwd == $pass){
        if($remark !='Approved'){
        $sql = "UPDATE unit request set remarks = '$remark',received = now() where No= '$id'";
        $sqlq = mysqli_query($sqlconnect,$sql);
        $_SESSION['status'] = "Submit!";
        header('location: unitrequest.php');
        }else{
          $_SESSION['status'] = "You Select Approved You must assign codes";
          header('location: unitrequest.php');
        } 
      }
    }else{
  if($pwd == $pass){
    if($remark == 'Approved'){
    foreach($_GET['range'] as $select){
      $sql = "INSERT INTO barrowed (no_id,classifications,code,name,laboratory) values('$id','$class','$select','$name','$lab')  ";
      $sqlquery = mysqli_query($sqlconnect,$sql);
      if($sqlquery){
           $sql4 = "DELETE from codes where code = '$select' ";
           $sqlq4 =mysqli_query($sqlconnect,$sql4);
           if($sqlq4){
          $sql1 ="UPDATE unit_request set remarks = '$remark' ,received = now() where No = '$id' ";
          $sqlq = mysqli_query($sqlconnect,$sql1);
          if($sqlq){
            $sql5 ="SELECT count(no) as count from codes where classifications = '$class' and laboratory = '$lab'";
            $sql5q = mysqli_query($sqlconnect,$sql5);
            while($rs =$sql5q->fetch_assoc()){
                $count[] = $rs['count'];
            }
            $_SESSION['status'] = "Submit! $count[0] $class left  ";
            header('location: unitrequest.php');
            
          }
        }
      }else{
        echo "error";
      }
    }
  } else{
    $sql = "UPDATE unit request set remarks = '$remark' , received = now()  where No = '$id'";
    $sqlq = mysqli_query($sqlconnect,$sql);
    $_SESSION['status'] = "Submit!";
    header('location: unitrequest.php');
  }

  }else {
    $_SESSION['status'] = "Invalid password";
    header('location: unitrequest.php');
  }
  
  }
  //   if (empty($_GET['key'])) {
  //     $_SESSION['status'] ="Select First!";
  //     header('location: unitrequest.php');
  //  } else
  //   $date = date('Y-m-d');
  //   for($i = 0; $i<count($_GET['key']);$i++){

  //     $key = $_GET['key'][$i];
  //    $class  = $_GET['class_'.$key];
  //   //  $num = $_GET['num_'.$key][$i];
  //    $name = $_GET['name_'.$key];
  //    $remark  = $_GET['remark_'.$key];
  //    $code  = $_GET['code_'.$key];
  //    $recieved = $_GET['received_'.$key];
  //   echo $key.$class.$name.$remark.$code;
 
      
  //     $sql =  "UPDATE unit_request Set remarks = '$remark', unit_code = '$code', received = now(),returned = now()
  //          where no = $key;";
  //       $sqlquery = mysqli_query($sqlconnect,$sql);
      
  //       $sql1 = "INSERT into Recent VALUES('$code','Barrowed','$name','$remark')";
  //       $query = mysqli_query($sqlconnect,$sql1);
  //       if($query){
  //         $_SESSION['status'] = "Submit!";
  //         header('location: unitrequest.php');
  //       } 
  //     }
}
if(isset($_GET['submit_report'])){
  if (empty($_GET['key'])) {
    $_SESSION['status'] ="Select First!";
    header('location: unitrequest.php');
 } else
  $date = date('Y-m-d');
  for($i = 0; $i<count($_GET['key']);$i++){

    $key = $_GET['key'][$i];
   $remark  = $_GET['remark_'.$key];
   $name =$_GET['name_'.$key];
 // echo $key.$remark;

    
    $sql =  "UPDATE unit_reports Set remarks = '$remark'  where No = $key";
      $sqlquery = mysqli_query($sqlconnect,$sql);
    
      $sql1 = "INSERT into Recent VALUES('$code','Report','$name','$remark')";
      $query = mysqli_query($sqlconnect,$sql1);
      if($query){
        $_SESSION['status'] = "Submit!";
        header('location: reports.php');
      } 
    }

} if(isset($_GET['return'])){
  $id = $_GET['id'];
  $lab = $_GET['lab'];
  $class= $_GET['class'];
  $pass= $_GET['pass'];
  if($pwd == $pass){
  if(empty($_GET['range'])){
    $_SESSION['status'] = "Select Code First";
    header('location: adminbarrowed.php');
  }else{
        foreach($_GET['range'] as $select){
       
          $sql3 = "INSERT into codes (classifications,code,laboratory) values ('$class','$select','$lab')";
          $sqlq3  =mysqli_query($sqlconnect,$sql3);
          $sql = "DELETE from barrowed where code = '$select'";
          $sqlquery = mysqli_query($sqlconnect,$sql);
        } 
        if($sqlq3){
          
       $sql2 = "SELECT code from barrowed where no_id = '$id'";
       $sqlq2 = mysqli_query($sqlconnect,$sql2);
       if(mysqli_num_rows($sqlq2)>0){
        $_SESSION['status'] = "Still have an barrowed $class";
        header('location: adminbarrowed.php');
       }else{
          $sql3 ="UPDATE unit_request set returned= now() where No = '$id'";
          $sqlq3 = mysqli_query($sqlconnect,$sql3);
       }
      }else {
       echo "error";
      }
  }
}else{
  $_SESSION['status'] = "Invalid password";
  header('location: adminbarrowed.php');
}

}
  
?>

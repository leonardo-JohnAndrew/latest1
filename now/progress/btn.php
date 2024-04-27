<?php 
require('./database.php');
session_start();
 $class = $_SESSION['class'] ;

$lab = $_SESSION['lab'];
$ccount = count($class);
$lcount = count($lab);
if(isset($_POST['submit'])){

  for($r=1;$r<=$ccount; $r++){
    $cname = $_POST["class"][$s];
      for($i=0; $i<$lcount;$i++){
        $name = $lab[$i];
        $val = $_POST["$r"][$i];
        $sql = "UPDATE equipment set $name = $val  Where No = $r";
        $sqlquery = mysqli_query($sqlconnect ,$sql);
        if($sqlquery){
            $_SESSION['status'] ="Update Successfull!";
            header('location: laboratory.php');
        }
      }
          

     }
  
 }
if(isset($_POST['add'])){
  $class = $_POST['class'];
  $no = $_POST['no'];
  $code = $_POST['code'];
  $lab = $_POST['lab'];

  echo $class.$no.$code.$lab;
}


?>
 
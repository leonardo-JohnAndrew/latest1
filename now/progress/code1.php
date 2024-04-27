<?php 
require('./database.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          input{
            border: 0px solid;
            height: 20px;
      
            outline:none;
            background:transparent;
           
         } select{
          outline: 5px;
          outline-color: #0e2238;
          width: 120px;
          height:25px;
          min-width:  120px;
          gap: 0;
         } #Submit{
         background: linear-gradient(90deg, #4376A3 0%, #192C3D 100%);
         width: 150px;
         height: 30px;
         /* top: 910px;
         gap: 0px; */
         border-radius: 25px 25px 25px 25px;
         opacity:0px;
         color:white;
       }  thead {
        position: sticky;
        top:0px
       } 
       </style>
</head>
<body>
<form action="btn.php"  method="get">
   <div class="container-fluid">
    <div class="col mt-3  me-5 mb-5 text-secondary  " style="width: 100%; min-height:550px">
      <p class="fs-2 fw-lighter" style="font-style: italic ;">Codes
      <!-- <input type="submit" value="Add"name="add" style="height:50px">
      <input type="text" name="column" style="border :2px solid; outline:black ; ">  -->

      </p>
    <div class="row mb-3">
  <div class=" col-auto" >
  <label for="class  " style="color:#0e2238; font-weight:700 ;font-size: 14pt"  >Laboratory</label>
  </div>
   <div class="col-auto" >
   <input type="text" name="class" id= "class" class=" form-control " style="width: 200px;height: 30px" >
   </div>
   <div class="col-auto">
   <input type="submit" name = "add" value = "ADD" id = "Submit"> 
   </div>
    </div>
           
            
    
     
      <div style="max-height:500px;overflow-y:scroll">
       <table class="table table-striped "  >
         <thead  style="background-color:#0e2238; color:white">
         <?php $query = "SHOW COLUMNS FROM inventory";
           $results=mysqli_query($sqlconnect,$query);
           while ($fieldInfo = mysqli_fetch_array($results)) { 
           $columns[] = $fieldInfo[0];} ?>
            <th  class=" head  fs-6 fw-medium ">Laboratory</th>
            <th  class=" head  fs-6 fw-medium ">Classifications</th>
            <th  class=" head  fs-6 fw-medium ">Code</th>
          <?php
           $sqlaccounts ="SELECT Laboratory from inventory where Laboratory !=''";
           $result = $sqlconnect->query($sqlaccounts);
         $_SESSION ['row'] =  mysqli_num_rows($result);
            while(  $rows = $result->fetch_assoc()){?>
               <th  class=" head  fs-6 fw-medium "><?php echo $rows['Laboratory']?></th>
               
           <?php } ?>
         </thead>

         <div class="scroll">
         <tbody>
           
            
          <?php 
                $_SESSION['col'] = count($columns);
               $col = count($columns);
            $sqlaccounts ="SELECT * from inventory";
            $result = $sqlconnect->query($sqlaccounts);
          //  $_SESSION ['row'] =  mysqli_num_rows($result);
            while(  $rows = $result->fetch_assoc()) {
        ?>
        <tr>
           <td><input type="text" name="Lab_"<?=$rows['No']?> value="<?php echo $rows['Laboratory'] ?> " size="10px"></td>
           <td> <?php echo $rows['Classifications'] ?></td>
           <td><?php echo $rows['Code'] ?></td>
              
        <?php
             for($i=4; $i<$col; $i++){
            ?> 
                 <td><?php echo $rows ["$columns[$i]"]?>-1</td>
                <?php
                    
            } ?> 
        </tr>
            <?php
           }
          ?>
           
         </tbody>
         </div>
      </table>
      </div>
    </div>
    
  </div>
  <div class = "btn-group" style="margin-left:85%">
       <input type="submit" name = "update" value = "UPDATE" id = "Submit"> 
      </div>
 <?php 
   include('./footer.php')
   ?>
 

 </form>
</body>
</html>
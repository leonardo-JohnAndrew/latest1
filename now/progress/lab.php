<?php 
require('./database.php');

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
            height: 30px;
      
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
       }  .ans{
          border: 1px solid;
          border-color: #0e2238;
          outline: 2px;
          height: 31px;
          
       } label{
          font-size: 12pt;
          padding: 5px;
          font-weight: 700;
          color:  #0e2238;
       }
    </style>
    </style>
</head>
<body>
<form action="btn.php"  method="POST">
   <div class="container-fluid">
    <div class="col mt-3  me-5 mb-5 text-secondary  " style="width: 100%; min-height:550px">
    <?php 
              if(isset($_SESSION['status'])){
                ?>
                 <div class="alert alert-primary alert-dismissible fade show "  role="alert">
                   <strong>STATUS: </strong> <?php echo $_SESSION['status']  ?>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
                <?php
                      unset($_SESSION['status']);
              }
            ?>
      <p class="fs-2 fw-lighter" style="font-style: italic ;">Laboratory</p>
      <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color:#0e2238;border:0px solid;margin-left: 92%;width:70px">
      ADD
</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-diaglog-sm">
    <div class = "modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 "  id="exampleModalLabel">ADD CLASSIFICATION</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

          <div class="mb-3">
            <label for="class" >Classification</label><br>
            <input type="text" name="class" id= "class" class=" form-control " placeholder="Input Classification">
          </div>
          <div class="mb-3">
          <label for="class" >Quantity</label><br>
            <input type="text" name="no" id= "class" class="  form-control " size="25" value="0" placeholder="Input Quantity">
          </div>
          <div class="mb-3">
          <label for="class" >Code</label><br>
            <input type="text" name="code" id= "class" class=" form-control "size="25" placeholder="Input Code">
          </div>
          <div class="mb-3">
          <label for="class" >Laboratory</label><br>
            <input type="text" name="lab" id= "class" class=" form-control "size="25" placeholder="Input Available Laboratory">
          </div>
          
     
      </div>
      <div class="modal-footer">
      <input type="submit" name = "add" value = "ADD" id = "Submit"> 
      </div>
    </div>
  </div>
</div>

        
      <div style="max-height:500px;overflow-y:scroll">
       <table class="table table-striped" style="column-gap: 5px;"  >
         <thead   style="background-color:#0e2238; color:white">
              
                   <th class=" head  fs-6 fw-medium ">Classifications</th>
        <?php  $sqlaccounts ="SELECT Laboratory from inventory where Laboratory is not Null";
           $result = $sqlconnect->query($sqlaccounts);
            while(  $rows = $result->fetch_assoc()){
              $lab[] = $rows['Laboratory'];
              ?>
               
               <th class="head  fs-6 fw-medium" ><a href='lab1.php?id=<?=$rows['Laboratory']?>' style = "color:white; text-decoration:underline"><?php echo $rows['Laboratory']. " Laboratory"?></a></th>
                 
           <?php };
           $_SESSION ['lab'] = $lab ;
          
           ?>
          
         </thead>
         <tbody>
           
            <?php 
            $query  ="SELECT Laboratory from inventory where Laboratory is not null ";
            $rs = $sqlconnect->query($query);
            while ($fieldInfo = mysqli_fetch_array($rs)){
              $data[] = $fieldInfo[0];
            };
            $_SESSION ['data'] = $data;
            $col = count($data);
            $qury = "SELECT * FROM equipment" ;
            $rs = $sqlconnect->query($qury);
            $count = mysqli_num_rows($result);
            while($rows = $rs->fetch_assoc()){
              $class [] = $rows['Classifications'] ;
              ?>
              <tr>
                
                <td> <?=$rows['Classifications']?></td>
              <?php
            for($i = 0 ;$i <$col; $i++){
            ?>
           
          <td><input type="text" name="<?=$rows['No']?>[]" value="<?= $rows["$data[$i]"]?>" ></td>
            
           <?php 
          }?>
              </tr>
          <?php
          } ?>
           
         
         </tbody>
         <?php $_SESSION['class'] = $class  ?>
         </div>
      </table>
      </div>
    </div>
    
  </div>
  <div class = "btn-group" style="margin-left:85%">
       <input type="submit" name = "submit" value = "UPDATE" id = "Submit"> 
      </div>
  
 <?php 
   include('./footer.php')
   ?>
 

 </form>
</body>
  


</html>
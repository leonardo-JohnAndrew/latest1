<?php  require"./database.php";
if(isset($_GET['respon'])){
   $id = $_GET['num'];
   $name = $_GET['name']; ?>
   <input type="text" hidden  value="<?php echo $name ?>" name = "name">
      
    <div class="mb-3">
         <div class="input-group">
          <h5 class="fw-light">Request No:</h5>
         <input  style="font-size:15pt;"  type="text" name="id_num" value="<?php echo $id ?>">
         </div>
    </div>
   <div class="mb-3">
   <h5>Laboratory</h5>
   <select class="form-control" id = "labname" style="font-size: smaller;" name="Laboratory" id= 'lab'>
   <?php  $sql1 = "SELECT Laboratory from inventory where laboratory is not null";
               $quey1 = mysqli_query($sqlconnect,$sql1);
             while($rs = $quey1->fetch_assoc()){?>
         <option value="<?= $rs['Laboratory']?>"><?php echo $rs['Laboratory'] ?></option>
       <?php  } ?>
   </select>
  </div>

  <div class="mb-3">
  <h5>Classification</h5>
  <select class="form-control" id = "classname" style="font-size: smaller;" name="class" id= 'lab'>
   <?PHP $query = "SELECT distinct classifications from codes " ;
           $sqlquery = mysqli_query($sqlconnect,$query);
           while ($rows = $sqlquery->fetch_assoc()) { 
             ?>
             <option value="<?php echo $rows['classifications'] ?>"><?php echo $rows['classifications'] ?></option>
          <?php }?>
   </select>
  </div>
 
      <div class="mb-3">
      <button type="button" class="btn butn" style="color: white;" >Codes</button>

      </div>
      <div class="mb-3">
    <div class="select">
         <option value=""></option>
</div>
  </div>

  <div class="mb-3">
     <h5>Remark</h5>
     <select style="font-size: smaller;" name="remark"  class="form-select" >
     <option value="" selected= ""></option>
    <option value="Approved">Approved</option>
    <option value="Canceled">Canceled</option>
    <option value="Declined">Declined</option>
         </option>
         </option>
        </select>
     </div>


     <div class="mb-3">
    <h5>Password</h5>
       <input type="password" class="form-control"  class="password" name = "pass" style="height: 35px;" placeholder="Enter your password: ">
     </div>


     <script src = "jquery.js"></script>
<script>
  $(document).ready(function() {
    $(".btn").on("click", function() {
    
        $.ajax({
            url:"xamp.php",
            type : "GET",
            data:$('#getVal').serialize(),
            success:function(data){
              $(".select").html(data)
            }
        
        })
      
        
    });
});

</script>

    <?php
} if(isset($_GET['view'])){
   $id = $_GET['num'];
   $class =$_GET['class'];
  $sql = "SELECT DISTINCT Laboratory as lab   from barrowed where no_id = $id";
  $sqlq = mysqli_query($sqlconnect,$sql);
  while($rs = $sqlq->fetch_assoc()){
      $lab[] = $rs['lab'];
      
  }   ?>
  <input type="text" name="id" value="<?php echo $id ?>" hidden>
  <input type="text" name="class" value="<?php echo $class ?>" hidden>
  <input type="text" name="lab" value="<?php echo $lab[0] ?>" hidden>
 
    <div class="mb-3">
    <h5>Codes: </h5>
    <select name="range[]" class= form-control multiple  style="height:300px;overflow-y:scroll" >
    
    <?php  $sql1 = "SELECT code from barrowed where no_id ='$id' ";
                       $quey1 = mysqli_query($sqlconnect,$sql1);
                     while($rs = $quey1->fetch_assoc()){?>
               //  <option value="<?= $rs['code']?>"><?php echo $rs['code'] ?></option>
               <?php  }  
               ?>
    </select>
      
    </div>
    <div class="mb-3">
      <h5>Password</h5>
      <input type="password" name="pass" class="form-control" style="height: 30px;">
    </div>

  <?php
}


?>
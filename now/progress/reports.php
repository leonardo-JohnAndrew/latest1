<!DOCTYPE html>
<?php 
session_start();
include('./header.php');
$name = $_SESSION['name'];
require('./database.php');
 ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unit Reports</title>
  
      <style>
         #pending{
           background: linear-gradient(90deg, #4376A3 0%, #192C3D 100%);
           width: 240px;
           border-radius: 25px 25px 25px 25px;
           opacity:0px;
           color:white;
           margin-left: 850px ;
         }  a{
    text-decoration: none;
  } 
  input{
            border: 0px solid;
            height: 20px;
            outline:none;
            background:transparent;
           
         }select{
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
    <div class="wrapper">
        <aside id="sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                     <center class="profile">
                      <i class="fa-solid fa-image"></i><br>
                      <span><?php echo $_SESSION['name'] ?></span>
                     
                     </center>
                    </a>
                </li>
                 <ul class ="sidebar-nav">
                     <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"     data-bs-target="#invent" aria-expanded="false" aria-controls="invent">
                        <i class="fa-solid fa-list"></i><span>Inventory<span>
                        </a> 
                          <ul id="invent" class ="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"  >
                            <li class="sidebar-item">
                                <a href="laboratory.php" class="sidebar-link">Laboratory</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="codes.php" class="sidebar-link">Codes</a>
                            </li>
                          </ul>
                     </li>
                     <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"     data-bs-target="#report" aria-expanded="false" aria-controls="report">
                           <i class="fa-solid fa-file"></i>
                           <span>Reports</span>
                        </a> 
                          <ul id="report" class ="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"  >
                            <li class="sidebar-item">
                                <a href="pending.php" class="sidebar-link">Pendings</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="reports.php" class="sidebar-link">Unit Reports</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="unitrequest.php" class="sidebar-link">Unit Request</a>
                            </li>
                          </ul>
                       </li>
                        <li class="sidebar-item">
                         <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"     data-bs-target="#manage" aria-expanded="false" aria-controls="manage">
                          <i class="fa-solid fa-user"></i><span>User Management<span>
                         </a>
                           <ul id="manage" class ="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"  >
                              <li class="sidebar-item">
                                <a href="management.php" class="sidebar-link">Manage Accounts</a>
                              </li>
                              <li class="sidebar-item">
                                <a href="createaccounts.php" class="sidebar-link">Create Accounts
                                </a>
                              </li>
                           </ul>
                          </li>
                        </li>
                        <!-- <li class="sidebar-item">
                         <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"     data-bs-target="#status" aria-expanded="false" aria-controls="status">
                          <i class="ffa-solid fa-desktop"></i><span>Status<span>
                         </a>
                           <ul id="status" class ="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"  >
                              <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Usage</a>
                              </li>
                              <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Laboratory Management
                                </a>
                              </li>
                             </ul>
                           </li>
                          </li> -->
                       </ul>
        </aside>
      <div class="main">
       <form action="add.php" class="get">
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
      <p class="fs-2 fw-lighter" style="font-style: italic ;">Units Request
     </p>
     <div style="max-height:500px;overflow-y:scroll">
       <table class="table table-striped "  >
         <thead  style="background-color:#0e2238; color:white">
           <th>No</th>
           <th  class=" fs-6 fw-medium"style="">Classification</th>
           <th class="fs-6 fw-medium" >Code</th>
           <th  class=" head fs-6 fw-medium">Problem</th>
           <th  class=" head  fs-6 fw-medium">Date Reported
           </th>
           <th  class=" head  fs-6 fw-medium">Reported By</th>
           <th  class=" head  fs-6 fw-medium">Remarks</th>
          
         </thead>
         <div class="scroll">
         <tbody>
         <?php 
           $sqlaccounts ="SELECT * from unit_reports where remarks is null";
           $result = $sqlconnect->query($sqlaccounts);
           if(!$result){
               echo"error select";
           }
           while($rows = $result->fetch_assoc()){
         ?>
           <tr>
           <td> <input type="checkbox" name ="key[]" value="<?php echo $rows['No'] ?>"></td>
            <td><input type="text" name="class_<?= $rows['No'] ?>" value="<?php  echo $rows['classification'] ?>" size="10px" readonly></td>
            <td><input type="text" name="code_<?= $rows['No']?>" value="<?php echo $rows['unit_code'] ?>" size="10px" readonly></td>
             <td><input type="text" name="problem_<?= $rows['No'] ?>" value="<?php  echo $rows['problem'] ?>" size="10px" readonly></td>
             <td><input type="text" name="date_<?= $rows['No'] ?>" value="<?php echo $rows['date_report'] ?>" size="20px" readonly></td>
             <td><input type="text" name="name_<?= $rows['No']?>" value="<?php echo $rows['reported_by'] ?>" size="20px" readonly></td>
             <td><select style="font-size: smaller;" name="remark_<?= $rows['No']?>" >
             <option selected>Remark</option>
             <option value="Not Working">Not Working
              <option value="Malfunction">Malfunction
              <option value="Other">Other</option>
              <option value="Fixed">Fixed</option>
              </option>
              </option>
             </select></td> 
             
            <?php }?>
         </tbody>
         </div>
      </table>
     </div>
    </div>
  </div>
  <div class = "btn-group" style="margin-left:85%">
       <input type="submit" name = "submit_report" value = "SUBMIT" id = "Submit"> 
      </div>
 <?php 
   include('./footer.php');


   ?>
       </form>
       
      </div>
</div>
<script src="script.js"></script>


</body>

</html>
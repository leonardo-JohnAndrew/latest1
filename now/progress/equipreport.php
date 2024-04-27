<!DOCTYPE html>
<?php 
session_start();
include('./header.php');
//if($_SESSION["validate"] != "accept"){
 // header('location:login.php');
//}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LABVISION</title>
</head>
<style>
  a{
    text-decoration: none;
  }
</style>
<body>
    <div class="wrapper">
        <aside id="sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                     <center class="profile">
                      <i class="fa-solid fa-image"></i><br>
                      <span>Rose Ann</span>
                      <span>De Guzman</span>
                     </center>
                    </a>
                </li>
                 <ul class ="sidebar-nav">
                 <li class="sidebar-item">
                    <a href="" class="sidebar-link">
                        <img src="./pic/attendance.png" alt="logo" width="25px">
                        <span>E-Monitoring</span>
                    </a>
                   </li>
                     <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#report" aria-expanded="false" aria-controls="report">
                        <img src="./pic/report.png" alt="logo" width="25px">
                           <span>Reports</span>
                        </a> 
                          <ul id="report" class ="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"  >
                            <li class="sidebar-item">
                                <a href="requestview.php" class="sidebar-link">Equipment Request Viewing </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link">Equipment Report Viewing </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="" class="sidebar-link">Equipment Report</a>
                            </li>
                          </ul>
                       </li>
                       <li class="sidebar-item">
                    <a href="faculty.php" class="sidebar-link">
                        <img src="./pic/request.png" alt="logo" width="25px">
                        <span>Equipment Request</span>
                      </a>
                        </li>
                        </li>
                        <li class="sidebar-item">
                    <a href="equipreport.php" class="sidebar-link">
                        <img src="./pic/request.png" alt="logo" width="25px">
                        <span>Report Equipment</span>
                      </a>
                        </li>
                     
                       </ul>
                 </aside>
      <div class="main">
       <style>
        *{
  margin: 0;
  padding: 0;
  list-style: none;
  text-decoration: none;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

.main--title{
  font-family: Poppins;
  font-size: 50px;
  font-style: italic;
  font-weight: 250;
  line-height: 105px;
  text-align: left;
}


.form-box{
  width: 100%;
  max-width: 900px;
  border: 1px solid ;
  outline: #0E2238;
  height: 600px;
  padding: 30px 200px 30px;
  text-align: center;
  /* border-radius: 50px; */
  box-shadow: 0px 5px 1px 2px lightslategray;
}

.input-field{
  /* background: #eaeaea; */
  border: 1px solid;
  outline: #192C3D;
  margin: 15px 0;
  width: 450px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  max-height: 50px;
  transition: max-height 0.5s;
  overflow: hidden;
}

input {
  width: 100%;
  background: transparent;

  padding: 18px 15px;
}

#input{
    

  /* background: #eaeaea; */
  border: 1px solid;
  outline: #192C3D;
  margin: 15px 0;
  width: 450px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  max-height: 50px;
  transition: max-height 0.5s;
  overflow: hidden;

}

.input-group {
  height: 280px;
}
#create{
         background: linear-gradient(90deg, #4376A3 0%, #192C3D 100%);
         width: 150px;
         height: 50px;
         margin-left: 300px;
         /* top: 910px;
         gap: 0px; */
         border-radius: 25px 25px 25px 25px;
         opacity:0px;
         color:white;
       } 

       </style>
        <!--sidebar end-->
        <!--main container start--> 
        <div class="main-container " style="margin-bottom:200px; margin-left:200px;margin-top:30px" >
            <h2 class="container-fluid mb-5" style="margin-left: 250px;">EQUIPMENT REPORT</h2>
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
                <div class="form-box">
                    <form action="add.php" method="get">
                        <div class="input-group">
                           
                            <div >
                            <H6 style="margin-right:500px ;">Name</H6>
                                <input type="text" placeholder="Name" name ="name" class="input-field" value="<?php echo $_SESSION['name'] ?>">
                            </div>
                            <div>
                            <H6  style="margin-right:350px ;">Classification</H6>
                                <input type="text" placeholder="Classification"name = "class" class="input-field" >
                            </div>
                            <div>
                            <H6  style="margin-right:350px ;">Laboratory</H6>
                                <input type="text" placeholder="Laboratory"name = "lab" class="input-field" >
                            </div>
                       
                            <div>
                            <H6  style="margin-right:350px ;">Unit No</H6>
                                <input type="text" placeholder="Unit no." name = "pc_unit"class="input-field">
                            </div>
                            <H6 style="margin-right:350px ;">Problem</H6>
                                <input type="text" placeholder="Problem." name = "prob" id = "input">
                        
                            <button id = "create"  class="" name="report"> SUBMIT</button>
                        </div>
                        <!-- <input type="submit" name = "create" value = "CREATE" id = "create" class="mt-5">  -->
                      
                    </form>
                    
                </div> 
            </div>
        <!--main container end-->


    <!--wrapper end-->

        <?php 
          include('./footer.php') ?>

      </div>
    </div>
   
    <script src="script.js"></script>

</body>

</html>
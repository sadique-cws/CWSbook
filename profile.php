<?php 
include_once "include/config.php";

$log = $_SESSION['user'];

$data = callingJoinData('account','details'," ON account.user_id=details.account_id where account.email='$log' or account.contact='$log'",true);

//echo "<pre>";
//print_r($data);
//echo "</pre>";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CWSBook.com | connect Togather</title>
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
    <body class="bg-light">
       
       <?php include "include/nav.php"; ?>
        
        
        <div class="container mt-5">
           <div class="row">
               <?php 
               $id = $data['user_id'];
               $check = countData('details'," account_id='$id'");
               
               if($check < 1):
               ?>
               
              <div class="col-12">
                   <div class="alert alert-danger">
                   <strong>Profile Incompleted</strong> <br/> please complete your profile by click on this link 
                   
                   <a href="details_form.php" class="alert-link">Click Here</a>
               </div>
              </div>
               
               <?php endif; ?>
           </div>
           
           
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <img src="images/dp/<?= $data['image'];?>" alt="dp" class="card-img-top">
                        <div class="card-body text-center">
                           <h2 class="h6 text-uppercase"><?= $data['first_name'];?></h2>
                           <h2 class="h6 text-uppercase"><?= $data['gender'];?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                            <form action="">
                                <textarea name="" id="" cols="30" rows="6" class="form-control" placeholder="Write Something here"></textarea>
                                
                            </form>
                            <div class="card-body">
                                <input type="file">
                                <input type="submit" class="btn btn-primary btn-sm float-right">
                            </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    
                </div>
            </div>
        </div>
    </body>
</html>
<?php 
include_once "include/config.php";


if(!isset($_SESSION['user'])){
    redirect('index');
}

$log = $_SESSION['user'];

$data = callingJoinData('account LEFT JOIN','details'," ON account.user_id=details.account_id where account.email='$log' or account.contact='$log'",true);

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
                    <strong>Profile Incompleted</strong> <br /> please complete your profile by click on this link

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
                <form method="post" enctype="multipart/form-data">
                    <div class="card">
                        <textarea name="post_content" cols="30" rows="6" class="form-control" placeholder="Write Something here"></textarea>

                        <div class="card-body">
                            <input type="file" name="post_image">
                            <input type="submit" name="post_send" class="btn btn-primary btn-sm float-right">
                        </div>
                    </div>
                </form>
                
                
                <?php 
                $post = callingJoinData("account JOIN","posts"," ON account.user_id = posts.post_by ORDER BY post_id DESC");
                
                foreach($post as $p):
                
                ?>
                
                <div class="media mt-4">
                  
                  <div class="media-left">
                      <img src="http://via.placeholder.com/50" class="rounded-circle media-object mr-2">
                  </div>
                  <div class="media-body">
                      <h2 class="h6 text-capitalize mb-0"><?php echo $p['first_name'] . " " . $p['last_name'];?></h2>
                      <small class="text-muted"><?= date("D d M Y H:i A",strtotime($p['post_doc']));?></small>
                      
                   <img class="px-4" src="<?php echo "images/post/".$p['post_image'];?>" alt="" width="100%">
                    <div class="card-body">
                  </div>
                        
                    </div>
                </div>
                
                <?php endforeach; ?>
            </div>
            <div class="col-lg-3">

            </div>
        </div>
    </div>
</body>

</html>




<?php 
if(isset($_POST['post_send'])){
    
    //image work
    
    $post_img = $_FILES['post_image']['name'];
    $post_tmp_img = $_FILES['post_image']['tmp_name'];
    
    move_uploaded_file($post_tmp_img,"images/post/$post_img");
    
    $data = [
        'post_content' => $_POST['post_content'],
        'post_image' => $post_img,
        'post_by' => $data['user_id']
    ];
    
    if(insertData("posts",$data)){
        redirect('profile');
    }
    else{
        echo  "error";
    }
}
?>
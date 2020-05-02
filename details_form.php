<?php 
include_once "include/config.php";

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
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                       <h4>Fill Below Details</h4>
                        <form method="post" enctype="multipart/form-data">
                                
                                <div class="form-group">
                               <label class="m-0 p-0 text-muted d-block mb-2">Gender</label>
                                <div class="custom-control d-inline custom-radio">
                                    <input type="radio"  id="male" name="gender" value="male" class="custom-control-input" checked>
                                    <label for="male" class="custom-control-label">Male</label>
                                </div>
                                
                                <div class="custom-control d-inline custom-radio">
                                    <input type="radio" id="female" name="gender" value="female" class="custom-control-input">
                                    <label for="female" class="custom-control-label">Female</label>
                                </div>
                                
                                <div class="custom-control d-inline custom-radio">
                                    <input type="radio" id="other" name="gender" value="other" class="custom-control-input">
                                    <label for="other" class="custom-control-label">Other</label>
                                </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="" class="m-0 p-0 text-muted">Nationality</label>
                                    <select name="nationality" id="" class="form-control">
                                        <option disabled selected>Select Nationality</option>
                                        <option value="indian">Indian</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="m-0 p-0 text-muted">Display Picture</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image">
                                        <label for="" class="custom-file-label">Choose Image...</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="m-0 p-0 text-muted">City</label>
                                    <select name="city" id="" class="form-control">
                                        <option disabled selected>Select city</option>
                                        <option value="purnea">purnea</option>
                                        <option value="patna">patna</option>
                                        <option value="pune">pune</option>
                                        <option value="delhi">delhi</option>
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="m-0 p-0 text-muted">State</label>
                                    <select name="state" id="" class="form-control">
                                        <option disabled selected>Select state</option>
                                        <option value="bihar">bihar</option>
                                        <option value="UP">UP</option>
                                        <option value="maharastra">maharastra</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="m-0 p-0 text-muted">Pin Code</label>
                                    <input type="number" name="pin_code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="send" class="btn btn-info btn-block">
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php 
if(isset($_POST['send'])){
    
    // image work
    $img = $_FILES['image']['name'];
    $tmp_img = $_FILES['image']['tmp_name'];
    
    move_uploaded_file($tmp_img,"images/dp/$img");
    
    $data = [
        'account_id' => $data['user_id'],
        'gender' => $_POST['gender'],
        'nationality' => $_POST['nationality'],
        'image' => $img,
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'pin_code' => $_POST['pin_code']
    ];
    
    if(insertData('details',$data)){
        redirect('profile');
    }
    else{
        echo "fail";
    }
}
?>
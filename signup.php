
<?php
include('imageprocess.php');
?>

<?php 
    include('conn.php');
    $msg = "";
    // 
    if(isset($_POST['signup'])){
     
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $files = $_FILES['profileImage'];
 $profileImage = upload_profile('./images/',$files);

        if(preg_match("!images!", $_FILES['profileImage']['type'])){
          if(copy($_FILES['profileImage']['tmp_name'],$profileImage_path)){
            $_SESSION{'profileImage'}=$profileImage_path;
          }
        }
        
        if($lastname == "" || $firstname == "" || $email == "" || $password == "" || $cpassword == ""){
            $msg = '<p style="color: red; text-align: center;">Invalid parameters</p>';
        }else {
            if($password !== $cpassword){
                $msg = '<p style="color: red; text-align: center;">Password not matched</p>';
            }else {

                // hash
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $checkUser = "SELECT * FROM `users` WHERE `email` = '$email'";
                $rs = mysqli_query($sql, $checkUser);
                $count = mysqli_num_rows($rs) >0;
                if($count){
                    $msg = '<p style="color: red; text-align: center;">Email already exist</p>';
                } else {



                    $addUser = "INSERT INTO `users`(`id`, `lname`, `fname`, `email`, `password`, `cpassword`,`profileImage`) VALUES (NULL,'$lastname','$firstname','$email','$hash','$hash','$profileImage')";

                    $result  = mysqli_query($sql, $addUser);
                    if($result){
                        session_start();
                        $_SESSION['user'] = $email;
                        header('Location: index.php');
                    }else{
                        $msg = "Something went wrong";
                    }
                }
            }
        }
    }


?>



<?php
//header.php
include('header.php');

?>
<section id="register">
  <div class="container">
    <div class="row">
      <div class="col-4 offset-md-4 form-div">
        
          
          <span class="font-ubuntu text-black-50 offset-lg-5">Already have an account?<a href ="index.php">Login</a></span>
          <div class="upload-profile-image">
          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
            <?php echo $msg;?>
            <label><h5>SIGN UP</h5></label>
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <small>choose image</small>
              </div>
              <form action="" method="POST" class="form"enctype="multipart/form-data" autocomplete="off" id="reg-form">
              <img src="images/man.png" width="35%" height="35%"  onClick="triggerClick()" class="img-rounded-circle" id="profileDisplay" alt="logo">
            </span>
            <input type="file"  name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control-file" style="display: none;">
            
          </div>
          
          <div class="container">
          <div class="form-group">
            <input type="text"  name="lastname" class="form-control" placeholder="FirstName">
          </div>
          <div class=" form-group">
          <input type="text"   name="firstname" class="form-control" placeholder="lastName">
          </div>
          <div class=" form-group">
          <input type="email"    required name="email" id="email" class="form-control" placeholder="Email*">
          </div>
          <div class=" form-group">
          <input type="password" required name="password" id="password"  class="form-control" placeholder="password*">
          <h4 id="confirm_error" class="text-danger"></h4>
        </div>
          <div class="form-group">
          <input type="password" required name="cpassword" id="confirm_pwd"  class="form-control" placeholder="confirm password*">          
        
          <div class="submit-btn text-center my-5">
            <button type="submit" name="signup" class="btn btn-warning rounded-pill text-dark px-5">Continue</button>

          </div>
          </div>
  </div>
          
        </form>
      </div>
    </div>
  <section id="register">

  <?php
     //footer.php
     include('footer.php');
     ?>


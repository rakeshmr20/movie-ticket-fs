<?php
// Developed by Rakesh M R
include_once 'utils/fileHandler.php';

$rusr = new UserManagement();
if (isset($_POST['form-type']) && $_POST['form-type'] == "registration") {
  $loginUsr = $rusr->addUser($_POST['username'], md5($_POST['password']));
  if ($loginUsr) {
    // proceed to home page
    // header('Location: ?page=login&smsg=Registration done Sucessfully.');
    echo "<script>window.location.href='?page=login&smsg=Registration done Sucessfully.';</script>";
    exit;
  } else {
    $_SESSION['errMsg'] = "Registration Failed. User already exists.!";
  }
  
}
?>
<div class="container module">
  <form action="" name="register-form" method="post" style="max-width:500px;margin:auto">
    <h2 class="page-title">Registration Form</h2>
    <input type="hidden" name="form-type" value="registration">
    <label id="errorMessage" class="errorMessage"><?php 
      if(isset($_SESSION['errMsg'])){ echo($_SESSION['errMsg']); 
      unset($_SESSION['errMsg']);} ?>
    </label>
    <div class="input-container">
      <i class="fa fa-user icon"></i>
      <input class="input-field" type="text" placeholder="Username" name="username" required>
    </div>
    <div class="input-container">
      <i class="fa fa-key icon"></i>
      <input class="input-field" type="password" placeholder="Password" name="password" required>
    </div>
    <div class="input-container">
      <i class="fa fa-key icon"></i>
      <input class="input-field" type="password" placeholder="Re-enter Your Password" name="repassword">
    </div>
    <button type="submit" class="btn login" onclick="return validform()">Register</button>
    <label class="move-right">Already have an account.? <a href="?page=login">Login</a></label>
  </form>
</div>

<script type="text/javascript">
  function validform() {

        var a = document.forms["register-form"]["username"].value;
        var b = document.forms["register-form"]["password"].value;
        var c = document.forms["register-form"]["repassword"].value;

        if (a==null || a=="")
        {
            alert("Please Enter Your Username");
            return false;
        }else if (b==null || b=="")
        {
            alert("Please Enter New Password");
            return false;
        }else if (c==null || c=="")
        {
            alert("Please Enter New Password");
            return false;
        }
        if (b!=c) {
          alert("Passwords Do Not Match.! Please Enter Correct Passwords");
          return false;
        }

    }
</script>
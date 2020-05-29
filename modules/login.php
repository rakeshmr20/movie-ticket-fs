<?php
// Developed by Rakesh M R
include_once 'utils/fileHandler.php';

$lusr = new UserManagement();
// print_r($usr->getSingleUser('name'));

if (isset($_POST['form-type']) && $_POST['form-type'] == "login") {
  $loginUsr = $lusr->getSingleUser($_POST['username']);
  if ($loginUsr) {
    if ($loginUsr[2] == md5($_POST['password'])) {
      // proceed in
      $_SESSION['userId'] = $loginUsr[0];
      $_SESSION['userName'] = $loginUsr[1];
      if ($loginUsr[3] == 100) {
        // header('Location: ?page=adminHome');
        echo "<script>window.location.href='?page=adminHome';</script>";
        exit;
      } else {
        // header('Location: ?page=userHome');
        echo "<script>window.location.href='?page=userHome';</script>";
        exit;
      }
    } else {
      $_SESSION['errMsg'] = "Login Failed. Password Do Not Match.!";
    }
  } else {
    $_SESSION['errMsg'] = "Login Failed. No User Found.!";
  }
}
?>

<div class="container module">
  <form action="" name="login-form" method="post" style="max-width:500px;margin:auto">
    <h2 class="page-title">Login Form</h2>
    <input type="hidden" name="form-type" value="login">
    <label id="successMessage" class="successMessage"><?php 
      if(isset($_GET['smsg'])){ echo($_GET['smsg']); unset($_GET['smsg']);} ?>
    </label>
    <label id="errorMessage" class="errorMessage"><?php 
      if(isset($_SESSION['errMsg'])){ echo($_SESSION['errMsg']); 
      unset($_SESSION['errMsg']);} ?>
    </label>
    <div class="input-container">
      <i class="fa fa-user icon"></i>
      <input class="input-field" type="text" placeholder="Username" name="username" autocomplete required>
    </div>
    
    <div class="input-container">
      <i class="fa fa-key icon"></i>
      <input class="input-field" type="password" placeholder="Password" name="password" required>
    </div>
    <button type="submit" class="btn login" onclick="return validform()" value="login">Login</button>
    <label class="move-right">Don't have an account.? <a href="?page=registration">Create Account</a></label>
  </form>
</div>

<script type="text/javascript">
  function validform() {

        var a = document.forms["login-form"]["username"].value;
        var b = document.forms["login-form"]["password"].value;

        if (a==null || a=="")
        {
            alert("Please Enter Your Username");
            return false;
        }else if (b==null || b=="")
        {
            alert("Please Enter Your Password");
            return false;
        }

    }
</script>
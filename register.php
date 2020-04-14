<?php include 'sql_connection.php';?>
<?php

require './user_class.php';

if (isset($_POST['submit'])) {
	
  if (!isset($_POST['firstname'], $_POST['lastname'], 
    $_POST['email'], $_POST['password'], 
    $_POST['confirmpassword'])) {
    die ('Please complete the registration form!');
  }

  if (empty($_POST['firstname']) || empty($_POST['lastname']) 
    || empty($_POST['email']) || empty($_POST['password'])
    || empty($_POST['confirmpassword'])) {
    die ('Please complete the registration form');
  }
  
  if (!$_POST['password'] === $_POST['confirmpassword'])
  {
    die ('Passwords do not match');
  }
  
  $user = new User();
  $newid = $user->addUser($con, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
  if ($newid != '') {
	  echo 'You have successfully registered, you can now login!';
	  header('Location: login.php');
  }
  
}
?>

<?php include 'top.php';?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h3 class="header center orange-text">Registration</h3>
    </div>
  </div>
  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s12" action="register.php" method="post" autocomplete="off">
          <div class="row">
            <div class="input-field col s6">
              <input id="firstname" name="firstname" type="text" class="validate" required="" aria-required="true">
              <label for="firstname">First Name</label>
            </div>
            <div class="input-field col s6">
              <input id="lastname" name="lastname" type="text" class="validate" required="" aria-required="true">
              <label for="lastname">Last Name</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="email" name="email" type="email" class="validate" required="" aria-required="true">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="password" name="password" type="password" class="validate" required="" aria-required="true">
              <label for="password">Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="confirmpassword" name="confirmpassword" type="password" class="validate" required="" aria-required="true">
              <label for="confirmpassword">Confirm Password</label>
            </div>
          </div>

          <div class="row center">
            <button id="download-button" type="submit" name="submit" class="btn-large waves-effect waves-light orange">Register</button>
          </div>

        </form>
      </div>
    </div>

    <br><br>
  </div>
  
<?php include 'bottom.php';?>

<script language='text/javascript'>
$(document).ready(function() {
    $('select').material_select();

    // for HTML5 "required" attribute
    $("select[required]").css({
      display: "inline",
      height: 0,
      padding: 0,
      width: 0
    });
  });
</script>

<?php include 'close_connection.php';?>
<?php include 'sql_connection.php';?>
<?php

if (isset($_POST['submit'])) {

  if (!isset($_POST['email'], $_POST['password'])) {
    die ('Please fill in both the Email and Password fields!');
  }


  if ($stmt = $con->prepare('SELECT userid, firstname, lastname, email, password FROM Users WHERE email = ?')) {
    $stmt->bind_param('s', $_POST['email']);
    $stmt->execute();
    // Result set
    $stmt->store_result();
  }

  if ($stmt->num_rows > 0) {
    $stmt->bind_result($userid, $firstname, $lastname, $email, $password);
    $stmt->fetch();
    // Account exists
    if (password_verify($_POST['password'], $password)) {
      // Session variables
      session_regenerate_id();
      $_SESSION['loggedin'] = TRUE;
      $_SESSION['userid'] = $userid;
      $_SESSION['email'] = $email;
      $_SESSION['name'] = $firstname . ' ' . $lastname;
      //echo 'Welcome ' . $_SESSION['name'] . '!';
	  header('Location: reviews.php');
    } else {
      echo 'Incorrect password!';
    }
  } else {
    echo 'Incorrect username!';
  }
  $stmt->close();
}
?>

<?php include 'top.php';?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h3 class="header center orange-text">Log in</h3>
    </div>
  </div>
  <div class="container">
    <div class="section">

      <div class="row">
        <form class="col s12" action="login.php" method="post">
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
          
          <div class="row center">
            <button id="download-button" type="submit" name="submit" class="btn-large waves-effect waves-light orange">Log in</button>
          </div>

        </form>

        <div class="row center">
          <h5 class="header col s12 light">Don't have an account yet? <a href="register.php">Register now</a>.</h5>
        </div>
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
<?php include 'sql_connection.php';?>
<?php include 'top.php';?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Welcome</h1>
      <div class="row center">
        <h5 class="header col s12 light">A mini project for restaurant reviews</h5>
      </div>
      <div class="row center">
        <a href="reviews.php" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>
      <br><br>

    </div>
  </div>
  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
            <h5 class="center">Easily add a new review</h5>

            <p class="light">Add a review for a new or existing restaurant.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">View all your previous reviews</h5>

            <p class="light">Your reviews will only be visible to you and nobody else.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Easy to work with</h5>

            <p class="light">This site is designed with Material design for easy access from any device.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>
  </div>
  
<?php include 'bottom.php';?>
<?php include 'close_connection.php';?>
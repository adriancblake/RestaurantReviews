<?php include 'sql_connection.php';?>
<?php

require './restaurant_class.php';

if (isset($_POST['submit'])) {
	if (!isset($_POST['restaurant_name'])) {
	die ('Please enter a restaurant name!');
	}

	if (empty($_POST['restaurant_name'])) {
	die ('Please enter a restaurant name!');
	}

	$restaurant = new Restaurant();
	$productid = $restaurant->addRestaurant($con, $_POST['restaurant_name']);
	// Add review
	if (!isset($_POST['rating'])) {
		$rating = 0;
	} else {
		$rating = $_POST['rating'];
	}
	if ($stmt = $con->prepare('INSERT INTO reviews (reviewid, productid, userid, description, rating, datecreated) VALUES (UUID(), ?, ?, ?, ?, NOW())')) {
		$stmt->bind_param('sssi', $productid, $_SESSION['userid'], $_POST['description'], $rating);
		$stmt->execute();
		header('Location: reviews.php');
	} else {
		echo 'Could not prepare statement!';
	}
	$stmt->close();
}
?>
<?php include 'top.php';?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Add Review</h1>
    </div>
  </div>
  <div class="container">
    <div class="section">
		<div class="row">
			<form class="col s12" action="add_review.php" method="post">
			  <div class="row">
				  <div class="input-field col s12 m6">
					  <input id="restaurant_name" name="restaurant_name" type="text" class="validate" required="" aria-required="true">
					  <label for="restaurant_name">Restaurant Name</label>
				  </div>
				  <div class="input-field col s12 m6">
					<select class="browser-default" name="rating">
						<option value="" disabled selected>Choose a rating (optional)</option>
						<option value="1">1 star</option>
						<option value="2">2 stars</option>
						<option value="3">3 stars</option>
						<option value="4">4 stars</option>
						<option value="5">5 stars</option>
					</select>
				  </div>
			  </div>
			  <div class="row">
				  <div class="input-field col s12">
					  <input id="description" name="description" type="text" class="validate" required="" aria-required="true">
					  <label for="description">Review details</label>
				  </div>
			  </div>
			  <div class="row center">
				<button id="download-button" type="submit" name="submit" class="btn-large waves-effect waves-light orange">Submit Review</button>
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
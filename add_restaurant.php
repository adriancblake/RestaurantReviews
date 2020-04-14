<?php include 'sql_connection.php';?>
<?php

if (isset($_POST['submit'])) {
    


  if (!isset($_POST['restaurant_name'])) {
    die ('Please enter a restaurant name!');
  }

  if (empty($_POST['restaurant_name'])) {
    die ('Please enter a restaurant name!');
  }

  // Check if exists
  if ($stmt = $con->prepare('SELECT name FROM products WHERE name = ?')) {
    $stmt->bind_param('s', $_POST['restaurant_name']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      // Already exists
	  $last_id = 
      echo 'Restaurant already exists, try adding a different one!';
    } else {
      // Restaurant doesnt exists, insert
      if ($stmt = $con->prepare('INSERT INTO products (productid, name) VALUES (UUID(), ?)')) {
        $stmt->bind_param('s', $_POST['restaurant_name']);
        $stmt->execute();
		$last_id = $con->insert_id;
        echo 'New Restaurant added successfully, you can now add a review!';
      } else {
        // Something is wrong with the sql statement
        echo 'Could not prepare statement!';
      }
    }
    $stmt->close();
  } else {
    echo 'Could not prepare statement!';
  }
}
?>
<?php include 'top.php';?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">New Restaurant</h1>
    </div>
  </div>
  <div class="container">
    <div class="section">
		<div class="row">
			<form class="col s12" action="add_restaurant.php" method="post">
			  <div class="row">
				  <div class="input-field col s12">
					  <input id="restaurant_name" name="restaurant_name" type="text" class="validate">
					  <label for="restaurant_name">Restaurant Name</label>
				  </div>
			  </div>
			  <div class="row center">
				<button id="download-button" type="submit" name="submit" class="btn-large waves-effect waves-light orange">Add Restaurant</button>
			  </div>
			</form>
		</div>
    </div>
    <br><br>
  </div>
  
<?php include 'bottom.php';?>
<?php include 'close_connection.php';?>
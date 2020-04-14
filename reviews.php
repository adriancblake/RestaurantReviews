<?php include 'sql_connection.php';?>
<?php include 'top.php';?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Reviews</h1>
	  <div class="row center">
	  <?php
		if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
			  echo '<p>Please <a href="login.php">log in</a> to view and add reviews.</p>';
		} else { 
			echo '<a href="add_review.php" id="download-button" class="btn-large waves-effect waves-light orange">Add Review</a>';
		} ?>
      </div>
    </div>
  </div>
  <div class="container">
  <?php
	// Get list of restaurants
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
		$userid = $_SESSION['userid'];
		$sql = "SELECT p.productid, p.name FROM products p
			INNER JOIN reviews r ON p.productid = r.productid 
			WHERE r.userid = '$userid'
			GROUP BY p.productid
			ORDER BY max(r.datecreated) DESC";
		$result = $con->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$productid = $row['productid'];
				$productName = $row['name'];
				echo '<h5 class="header">'. $productName .'</h5>';
				echo '<ul class="collection">';
				// Get list of reviews
				$sql = "SELECT u.firstname, u.lastname, r.description, r.rating, r.datecreated FROM reviews r
					INNER JOIN users u ON r.userid = u.userid 
					WHERE r.productid = '$productid'
					AND r.userid = '$userid'
					ORDER BY r.datecreated DESC";
				$reviewResult = $con->query($sql);
				if ($reviewResult->num_rows > 0) {
					while($row = $reviewResult->fetch_assoc()) {
						$firstname = $row['firstname'];
						$lastname = $row['lastname'];
						$description = $row['description'];
						$rating = $row['rating'];
						$datecreated = $row['datecreated'];
						echo '<li class="collection-item avatar">';
						if ($rating > 0) {
							for ($x = 0; $x < $rating; $x++) {
								echo '<i class="material-icons">grade</i>';
							}
							echo '<br/>';
						}
						echo '<span class="title">'. $firstname .' '. $lastname .'</span>';
						echo '<p>'. $datecreated .'<br/>';
						echo $description .'</p>';
						echo '</li>';
					}
				}
				echo '</ul>';
			}
		} else {
			echo '<p>No reviews yet. Try adding one!</p>';
		}
	}
  ?>
    </div>
    <br><br>
  </div>
  
<?php include 'bottom.php';?>
<?php include 'close_connection.php';?>
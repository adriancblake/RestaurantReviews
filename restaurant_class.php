<?php

class Restaurant
{
	private $con;
	private $id;
	private $name;

	public function __construct()
	{
		$this->con = NULL;
		$this->id = NULL;
		$this->name = NULL;
	}
	
	public function __destruct()
	{
		
	}

	/* Add a new user account and return its ID */
	public function addRestaurant($con, string $name): string
	{
		$con = $con;
		$newid = '';
		$name = $name;
		
		// Check if restaurant exists and get ID
		$sql = "SELECT productid FROM products WHERE name = '". mysqli_real_escape_string($con, $name) ."'";
		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$newid = $row['productid'];
			}
		} else {
			// Username doesn't exists, insert new account
			if ($stmt = $con->prepare('INSERT INTO products (productid, name) VALUES (UUID(), ?)')) {
				$stmt->bind_param('s', $name);
				$stmt->execute();
				// Get new ID
				$sql = "SELECT productid FROM products WHERE name = '". mysqli_real_escape_string($con, $name) ."'";
				$result = $con->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$newid = $row['productid'];
					}
				}
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				echo 'Could not prepare statement!';
			}
		}
		
		return $newid;
	}

}

?>
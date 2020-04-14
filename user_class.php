<?php

class User
{
	private $con;
	private $id;
	private $firstname;
	private $lastname;
	private $email;
	private $authenticated;

	public function __construct()
	{
		$this->con = NULL;
		$this->id = NULL;
		$this->firstname = NULL;
		$this->lastname = NULL;
		$this->email = NULL;
		$this->authenticated = FALSE;
	}
	
	public function __destruct()
	{
		
	}

	/* Add a new user account and return its ID */
	public function addUser($con, string $firstname, string $lastname, string $email, string $password): string
	{
		$con = $con;
		$newid = '';
		$firstname = trim($firstname);
		$lastname = trim($lastname);
		$email = trim($email);
		$password = trim($password);
		
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

		// Check if user exists
		if ($stmt = $con->prepare('SELECT userid, password FROM users WHERE email = ?')) {
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows > 0) {
			// Already exists
			echo 'User exists, please use another email account!';
		} else {
			// Username doesnt exists, insert new account
			if ($stmt = $con->prepare('INSERT INTO users (userid, firstname, lastname, email, password) VALUES (UUID(), ?, ?, ?, ?)')) {
				// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
				$password = password_hash($password, PASSWORD_DEFAULT);
				$stmt->bind_param('ssss', $firstname, $lastname, $email, $password);
				$stmt->execute();
				// Get new ID
				$sql = "SELECT userid FROM users WHERE email = '$email'";
				$result = $con->query($sql);
				if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						$newid = $row['userid'];
					}
				}
			echo 'You have successfully registered, you can now login!';
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				echo 'Could not prepare statement!';
			}
		}
		$stmt->close();
		} else {
			echo 'Could not prepare statement!';
		}
		
		return $newid;
	}

}

?>
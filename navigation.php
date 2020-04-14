<?php
	$LOGIN_PAGE = 'login';
	$LOGIN_TEXT = 'Log in';
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
	{
		$LOGIN_PAGE = 'logout';
		$LOGIN_TEXT = 'Log out';
	}
?>
        <li><a href="reviews.php">Reviews</a></li>
        <li><a href="<?=$LOGIN_PAGE?>.php"><?=$LOGIN_TEXT?></a></li>

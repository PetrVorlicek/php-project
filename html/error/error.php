<!DOCTYPE html>
<html>
<?php
$status = isset($_SERVER["REDIRECT_STATUS"]) ? $_SERVER["REDIRECT_STATUS"] : 400;
$codes = array(
	400 =>  array("400 Bad Request", "The request could not be processed."),
	401 => array("401 Unauthorized", "Unauthorized access. Please log in with valid credentials."),
	403 => array("403 Forbidden", "Forbidden acces."),
	404 => array("404 Not Found", "The site you requested does not exist."),
	500 => array("500 Internal Server Error", "The server had some problems. Please contact server administrator."),
);

$title = isset($codes[$status][0]) ? $codes[$status][0] : "ERROR";
$message = isset($codes[$status][1]) ? $codes[$status][1] : "Unknown error status. Please provide valid error.";
?>

<body>
	<hr>
	<h1><?= $title ?></h1>
	<hr>
	<p><?= $message ?></p>
	<hr>
</body>

</html>
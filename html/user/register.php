<?php
$username = "";
$password = "";
$usernameError = "";
$passwordError = "";
$success = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = htmlspecialchars($_POST["username"]);
	// TODO check how to sanitize passwords?
	$password = htmlspecialchars($_POST["password"]);
	if (strlen($password) < 8) {
		$passwordError = "Příliš krátké heslo!";
	}

	// connection to DB
	$db = connectDB();

	// check if user exists
	$usernameQuery = $db->prepare("SELECT COUNT(*)
									FROM account
									WHERE username = :username;");
	$usernameQuery->execute(["username" => $username]);
	$usernameCount = $usernameQuery->fetch(PDO::FETCH_ASSOC);
	if ($usernameCount["count"] !== 0) {
		$usernameError = "Nickname již existuje!";
	}

	// if there are no errors, process the request
	if ($passwordError === "" && $usernameError === "") {

		$pwHash = password_hash($password, PASSWORD_DEFAULT);
		$newAccountQuery = $db->prepare("INSERT INTO account (username, pw_hash, points, games, wins)
										VALUES (:username, :pwHash, 0,0,0);");
		$newAccountQuery->execute(["username" => $username, "pwHash" => $pwHash]);
		$success = "User created!";
	}
}
?>

<?php
$title = "Nový uchazeč";
$site = "Registrace";
include "./templates/php-home-header.php"; ?>
<div class="row justify-content-center text-white">
	<div class="col-md-8">
		<h3>Registrace</h3>
		<form method="post" action="#">
			<label for="username" class="form-label">Nickname</label>
			<input type="text" name="username" id="username" value="<?= $username; ?>" class="form-control">
			<p><?= $usernameError; ?></p>
			<br>
			<label for="password" class="form-label">Heslo</label>
			<input type="password" name="password" id="password" value="<?= $password; ?>" class="form-control">
			<p><?= $passwordError; ?></p>
			<br>
			<input class="btn btn-secondary" type="submit" value="Zaregistrovat!">
		</form>
		<p><?= $success; ?></p>
	</div>
</div>
<?php include "./templates/php-footer.php"; ?>
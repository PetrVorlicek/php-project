<?php
$username = "";
$password = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$username = htmlspecialchars($_POST["username"]);
	// TODO check how to sanitize passwords?
	$password = htmlspecialchars($_POST["password"]);

	// connection to DB
	$db = connectDB();

	// check if user exists
	$usernameQuery = $db->prepare("SELECT id, username, pw_hash
										FROM account
										WHERE username = :username;");
	$usernameQuery->execute(["username" => $username]);
	$userData = $usernameQuery->fetch(PDO::FETCH_ASSOC);
	if (empty($userData["username"]) || empty($userData["pw_hash"])) {
		$error = "Nevalidní login!";
	} else {
		// check if password and pw_hash match
		$validPw = password_verify($password, $userData["pw_hash"]);
		if ($validPw) {
			$success = "Úspěšné přihlášení!";
			$userId = $userData["id"];
			// redirect to user homepage
			header("Location: ./homepage?id=$userId");
			exit();
			// TODO set user session - into cookies, JWT, ...

		} else {
			$error = "Nevalidní login!";
		}
	}
}
?>

<?php
$title = "Login";
$site = "Login";
include "./templates/php-home-header.php"; ?>
<div class="row justify-content-center px-2">

	<div class="col-md-8 text-white">
		<h3>Přihlášení uživatele</h3>
		<form method="post" action="#">
			<?php if ($error != '') echo "<div class=\"alert alert-danger\">$error</div>"; ?>
			<label for="username" class="form-label">Uživatelské jméno:</label>
			<input type="text" name="username" id="username" value="<?= $username; ?>" class="form-control">
			<p></p>
			<br>
			<label for="password" class="form-label">Heslo</label>
			<input type="password" name="password" id="password" value="<?= $password; ?>" class="form-control">
			<p></p>
			<br>
			<input class="btn btn-secondary" type="submit" value="Přihlásit!">
		</form>
		<p><?= $success; ?></p>
	</div>

</div>
<?php include "./templates/php-footer.php"; ?>
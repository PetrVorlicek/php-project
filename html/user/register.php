<?php 
    $username = "";
    $password = "";
    $usernameError = "";
    $passwordError = "";
    $usernameCount = "";
    $success = "";
    if($_SERVER["REQUEST_METHOD"]==="POST")  {
    $username = htmlspecialchars($_POST["username"]);
    // TODO check how to sanitize passwords?
    $password = htmlspecialchars($_POST["password"]);
    if (strlen($password) < 8) {
        $passwordError = "Příliš krátké heslo!";
    }


    // connection to DB
    $dbHostname = "db";
    $dbname = "postgres";
    $dbUsername = "postgres";
    $dbPassword = "password";

    $dsn = "pgsql:host=$dbHostname;dbname=$dbname";
    $db = new PDO($dsn, $dbUsername, $dbPassword);

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
        $newAccountQuery->execute(["username"=>$username, "pwHash"=>$pwHash]);
        $success = "User created!";
    }
}
?>

<?php 
    $title="Nový uchazeč";
    $site="Registrace";
    include "./templates/php-home-header.php"; ?>
<h3>Registrace</h3>
<form method="post" action="">

    <label for="username">Nickname</label>
    <input type="text" name="username" id="username" value="<?=$username; ?>">
    <p><?= $usernameError; ?></p>
    <br>
    <label for="password">Heslo</label>
    <input type="text" name="password" id="password" value="<?=$password; ?>">
    <p><?= $passwordError; ?></p>
    <br>
    <input type="submit" value="Zaregistrovat!">
</form>
<p><?=$success; ?>
<?php include "./templates/php-footer.php"; ?>
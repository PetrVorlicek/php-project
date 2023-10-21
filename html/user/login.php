<?php
    $username = "";
    $password = "";
    $error = "";
    $success = "";

    if($_SERVER["REQUEST_METHOD"]==="POST")  {
        $username = htmlspecialchars($_POST["username"]);
        // TODO check how to sanitize passwords?
        $password = htmlspecialchars($_POST["password"]);
    
        // connection to DB
        $dbHostname = "db";
        $dbname = "postgres";
        $dbUsername = "postgres";
        $dbPassword = "password";
    
        $dsn = "pgsql:host=$dbHostname;dbname=$dbname";
        $db = new PDO($dsn, $dbUsername, $dbPassword);
    
        // check if user exists
        $usernameQuery = $db->prepare("SELECT username, pw_hash
                                        FROM account
                                        WHERE username = :username;");
        $usernameQuery->execute(["username" => $username]);
        $userData = $usernameQuery->fetch(PDO::FETCH_ASSOC);
        if(empty($userData["username"]) || empty($userData["pw_hash"])) {
            $error = "Nevalidní login!";
        } else {
            // check if password and pw_hash match
            $validPw = password_verify($password, $userData["pw_hash"]);
            if($validPw) { 
                $success = "Úspěšné přihlášení!";
            } else { 
                $error = "Nevalidní login!";
            }
        }
    }
?>

<?php 
    $title="Login";
    $site="Login";
    include "./templates/php-home-header.php"; ?>
<h3>Login</h3>
<form method="post" action="">
    <p><?= $error; ?></p>
    <label for="username">Nickname</label>
    <input type="text" name="username" id="username" value="<?=$username; ?>">
    <br>
    <label for="password">Heslo</label>
    <input type="text" name="password" id="password" value="<?=$password; ?>">
    <br>
    <input type="submit" value="Přihlásit!">
</form>
<p><?=$success; ?></p>
<?php include "./templates/php-footer.php"; ?>
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
        $db = connectDB();
    
        // check if user exists
        $usernameQuery = $db->prepare("SELECT id, username, pw_hash
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
    $title="Login";
    $site="Login";
    include "./templates/php-home-header.php"; ?>
<h3>Login</h3>
<form method="post" action="">
    <p><?= $error; ?></p>
    <label for="username">Nickname</label>
    <input type="text" name="username" id="username" value="<?=$username; ?>">
    <p></p>
    <br>
    <label for="password">Heslo</label>
    <input type="text" name="password" id="password" value="<?=$password; ?>">
    <p></p>
    <br>
    <input type="submit" value="Přihlásit!">
</form>
<p><?=$success; ?></p>
<?php include "./templates/php-footer.php"; ?>
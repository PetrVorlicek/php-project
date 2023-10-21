<?php 
    $title="Login";
    $site="Login";
    include "./templates/php-home-header.php"; ?>
<h3>Login</h3>
<form method="post" action="">
    <?php 
        $username = isset($_POST["username"]) ? $_POST["username"] :"";
        $password = isset($_POST["password"]) ? $_POST["password"] :"";
    ?>
    <label for="username">Nickname</label>
    <input type="text" id="username" value="<?=$username; ?>">
    <br>
    <label for="password">Heslo</label>
    <input type="text" id="password" value="<?=$password; ?>">
    <br>
    <input type="submit" value="Zaregistrovat!">
</form>
<?php include "./templates/php-footer.php"; ?>

<?php 
    // Get user by id and load his data
    $db = connectDB();
    $userId = isset($_GET["id"]) ? $_GET["id"] : -1;
    $userQuery = $db->prepare("SELECT username, points, games, wins
                                FROM account
                                WHERE id = :userId");
    $userQuery->execute(["userId"=> $userId]);
    $userData= $userQuery->fetch(PDO::FETCH_ASSOC);
    // TODO check client side session for auth
    if (empty($userData) || $userId === -1) {
        // tady asi nemusí být ten or check
        // redirect to error page
        header("Location: ./error");
    }
    $username = $userData["username"];
    $points = $userData["points"];
    $games = $userData["games"];
    $wins = $userData["wins"];
?>

<?php 
    $title="Uživatelský účet";
    $site="Profilová stránka";
    include "./templates/php-home-header.php"; ?>
<div>
    <h3>Profilová stránka<h3>
    <ul>
        <li>Nick: <?=$username; ?></li>
        <li>Body: <?=$points; ?></li>
        <li>Hry: <?=$games; ?></li>
        <li>Výhry: <?=$wins; ?></li>
    </ul>
</div>

<?php include "./templates/php-footer.php"; ?>
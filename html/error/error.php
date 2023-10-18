<?php
    $status = $_SERVER["REDIRECT_STATUS"];
    $codes = array(
        401 => array("401 Unauthorized","Unauthorized access. Please log in with valid credentials."),
        403 => array("403 Forbidden","Forbidden acces."),
        404 => array("404 Not Found","The site you requested does not exist."),
        
    );

    
    $title = $codes[$status][0];
    $message = $codes[$status][1];

?>
<!DOCTYPE html>
<html>
    <body>
        <h1><?=$title ?></h1>
        <p><?=$message ?></p>
    </body>
</html>

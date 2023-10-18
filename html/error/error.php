<?php
    $status = $_SERVER["REDIRECT_STATUS"];
    $codes = array(
        401 => array("401 Unauthorized","Unauthorized access. Please log in with valid credentials."),
        405 => array("403 Forbidden","Forbidden acces."),
        404 => array("404 Not Found","The site you requested does not exist."),
        
    );

    
    $title = isset($codes[$status][0])? $codes[$status][0]: "ERROR";
    $message = isset($codes[$status][1])? $codes[$status][1]: "Unknown error status. Please provide valid error.";

?>
<!DOCTYPE html>
<html>
    <body>
        <hr>
        <h1><?=$title ?></h1>
        <hr>
        <p><?=$message ?></p>
        <hr>
    </body>
</html>

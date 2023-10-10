<html>
    <body>
    <?php 
        $name = isset($_POST['name']) ? $_POST['name'] : "" ;
        $surname = isset($_POST['surname']) ? $_POST['surname'] : "";
        $greet = "";
        if (!($name AND $surname))
        {
            $greet = "<p>You unfortunatelly did not write your name. Hi, Anon!</p>";
        } else {
            $greet = "<p>Welcome, " . $name . " " . $surname . "!</p>";
        }
        
        if ($name == "Lukáš" AND $surname == "Jirůšek") {
            $greet = "<h1>Smrdíš</h1>";
        } 
        echo $greet;
    ?>
    <a href="index.php">Reset</a>
    </body>


</html>



<html>

<body>
    $_REQUEST:
    <?php #Print REQUEST data here ?>
    <br>
    $_GET:
    <?php #Print GET data here ?>
    <br>
    $_POST:
    <?php #Print POST data here ?>
    <form method="get">
        GET Form: <input type="text" name="get_name">
        <input type="submit" value="Submit GET">
    </form>
    <form method="post">
        POST Form: <input type="text" name="post_name">
        <input type="submit" value="Submit POST">
    </form>
    <a href="index.php">Reset</a>
</body>

</html>
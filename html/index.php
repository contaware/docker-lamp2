<?php
    function testDBConnection($servername, $dbname, $username, $password)
    {
        echo "<h2>Test the connection to $servername</h2>\n";
        echo "<pre>";

        // Test PDO
        try
        {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            echo "Connected successfully (with PDO)<br>";
            $conn = null; // close connection
        }
        catch (Throwable $e)
        {
            echo "Connection with PDO failed: " . $e->getMessage() . "<br>";
        }

        // Test MySQLi
        try
        {
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("utf8mb4");
            echo "Connected successfully (with MySQLi)<br>";
            $conn->close();
        }
        catch (Throwable $e)
        {
            echo "Connection with MySQLi failed: " . $e->getMessage() . "<br>";
        }
        echo "Note: \"Connection refused\" is returned when the DB server is starting.</pre>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docker LAMP</title>
</head>
<body>
    <h1>Docker LAMP</h1>
    <?php
        // Information
        echo "<h2>Information</h2>\n";
        echo "<pre>";
        echo "IP of mysqldb:      " . gethostbyname("mysqldb") . "<br>";
        echo "IP of mariadb:      " . gethostbyname("mariadb") . "<br>";
        echo "IP of phpmyadmin:   " . gethostbyname("phpmyadmin") . "<br>";
        echo "IP of web:          " . gethostbyname(gethostname()) . "<br>";
        echo "User running web:   " . exec("whoami") . "<br>";
        echo "Int range and size: " . PHP_INT_MIN . " to " . PHP_INT_MAX . " (" . PHP_INT_SIZE . " bytes)" . "<br>";
        echo "Year 2038 check:    " . (date("y", strtotime("2039-01-01")) == 39 ? "OK no bug" : "bug present!") . "<br>";
        echo "</pre>";

        // Test DB connections
        testDBConnection("mysqldb:3306", "blogdb", "blog", "1234");
        testDBConnection("mariadb:3306", "blogdb", "blog", "1234");
    ?>
    <hr>
    <a href="phpinfo.php" target="_blank">Show PHP info</a>
</body>
</html>
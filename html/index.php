<?php
    function testDBConnection($servername, $dbname, $username, $password)
    {
        echo "<h2>Test the connection to $servername</h2>\n";

        // Test PDO
        echo "<strong>Test with PDO</strong><br>\n";
        try
        {
            // Create connection and do query
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
            echo "Server version: " . $conn->getAttribute(PDO::ATTR_SERVER_VERSION) . "<br>\n";
            $res = $conn->query("SHOW DATABASES");
            
            // Loop through the database names
            $first = true;
            while ($name = $res->fetchColumn(0))
            {
                if ($first)
                {
                    $first = false;
                    echo "List of databases: ";
                }
                echo $name . ' ';
            }
            echo "<br>\n";

            // Close
            $conn = null;
        }
        catch (Throwable $e)
        {
            echo "PDO failed: " . $e->getMessage() . "<br>\n";
        }

        // Test MySQLi
        echo "<br>\n<strong>Test with MySQLi</strong><br>\n";
        try
        {
            // Create connection and do query
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $conn = new mysqli($servername, $username, $password, $dbname);
            $conn->set_charset("utf8mb4");
            echo "Server version: " . $conn->server_info . "<br>\n";
            $res = $conn->query("SHOW DATABASES");

            // Loop through the database names
            $first = true;
            while ($row = $res->fetch_array(MYSQLI_NUM))
            {
                if ($first)
                {
                    $first = false;
                    echo "List of databases: ";
                }
                echo $row[0] . ' ';
            }
            echo "<br>\n";

            // Close
            $res->close();
            $conn->close();
        }
        catch (Throwable $e)
        {
            echo "MySQLi failed: " . $e->getMessage() . "<br>\n";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Docker LAMP2</title>
</head>
<body>
<h1>Docker LAMP2</h1>
<?php
    // Information
    date_default_timezone_set('UTC');
    echo "<h2>Information</h2>\n";
    echo "<pre>\n";
    echo "PHP Version:        " . phpversion() . "\n";
    echo "IP of webserver:    " . gethostbyname(gethostname()) . "\n";
    echo "Id of webserver:    " . exec("id") . "\n";
    echo "IP of db:           " . gethostbyname("db") . "\n";
    echo "IP of phpmyadmin:   " . gethostbyname("phpmyadmin") . "\n";
    echo "Int size:           " . PHP_INT_SIZE . " bytes" . "\n";
    echo "Year 2038 check:    " . (date("y", @strtotime("2039-01-01")) == 39 ? "OK no bug" : "bug present!") . "\n";
    echo "</pre>\n";

    // Test DB connection
    echo "<p>For the following tests a \"Connection refused\" may be returned when the DB server is starting.</p>\n";
    testDBConnection("db:3306", "blogdb", "blog", "1234");
?>
<br>
<hr>
<a href="phpinfo.php" target="_blank">Show PHP info</a>
</body>
</html>
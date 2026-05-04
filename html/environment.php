<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Environment var</title>
</head>
<body>
<h1>Environment var</h1>
<?php
echo "\$_SERVER: ";
if (isset($_SERVER['MYVAR']))
    echo htmlspecialchars($_SERVER['MYVAR'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
echo "<br>\n\$_ENV: ";
if (isset($_ENV['MYVAR']))
    echo htmlspecialchars($_ENV['MYVAR'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
echo "<br>\ngetenv(): " . htmlspecialchars(getenv('MYVAR'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "<br>\n";
?>
</body>
</html>
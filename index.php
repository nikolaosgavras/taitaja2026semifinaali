<?php include 'config/conn.php';
    
// Test database connection
try {
    $link = createMysqliConnection();
    echo "✓ Database connected successfully!<br>";
    echo "Database: " . mysqli_get_host_info($link) . "<br><br>";
} catch (Exception $e) {
    die("✗ Connection failed: " . $e->getMessage());
}

session_start();



mysqli_close($link);

?>



<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etusivu</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
</body>
</html>
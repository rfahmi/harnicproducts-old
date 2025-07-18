<?php
echo "<base href='http://localhost:8000/'>";
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/DatabaseHelper.php';

$db = Database::getInstance();
$link = $db->getConnection();

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
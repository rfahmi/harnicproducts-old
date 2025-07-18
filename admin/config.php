<?php
echo "<base href='http://localhost:8000/admin/'>";
require_once __DIR__ . '/includes/Database.php';
require_once __DIR__ . '/includes/DatabaseHelper.php';

try {
    $db = Database::getInstance();
    $link = $db->getConnection(); // Keep $link for backward compatibility
    DatabaseHelper::init();
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
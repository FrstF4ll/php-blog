<?php
try {

$dbPath = __DIR__ . '/../database.db';
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $pdo;
} catch (PDOException $e) {
    die("Connection failed : " . $e->getMessage());
}
?>
<?php

try {

    $dbPath = __DIR__ . '/../database.db';
    $dbDir = dirname($dbPath);

    if (!is_writable($dbDir)) {
        throw new Exception("Database directory is not writable");
    }

    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!file_exists($dbPath)) {
        throw new Exception("Database file not found: $dbPath");
    }

} catch (PDOException $e) {
    throw new Exception("Failed to connect to database: " . $e->getMessage());
} catch (Exception $e) {
    throw $e;
}
return $pdo;

<?php

$pages = [
        'home' => '../views/pages/home.php',
        'login' => '../views/pages/login.php',
        'register' => '../views/pages/register.php',
        'create' => '../views/pages/create_post.php',
        'manage' => '../views/pages/manage_posts.php',
        'edit' => '../views/pages/edit_post.php',
        'post' => '../views/pages/blog_post.php',
];

$request = $_GET['pages'] ?? 'home';
$templates = $pages[$request] ?? null;

try {
    $dbPath = __DIR__ . '/../database.db';
    $pdo = new PDO('sqlite:' . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed : " . $e->getMessage());
}
?>


<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/svg+xml" href="assets/favicon.svg">
    <title>php-blog - Home</title>
</head>
<body class="grid grid-rows-[auto_1fr_auto] min-h-full">
<?php include "../views/components/navbar.php"; ?>
<main>

    <?php if ($templates): ?>
        <?php include $templates; ?>
    <?php else: ?>
        <?php http_response_code(404);
        echo '<h1>404 - Not found</h1>';
        echo '<p>The page you requested does not exist.</p>'
        ?>
    <?php endif; ?>
</main>

<?php include "../views/components/footer.php"; ?>

</body>
</html>
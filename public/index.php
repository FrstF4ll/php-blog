<?php
$pages = [
        'home' => '../views/pages/home.php',
        'login' => '../views/pages/login.php',
        'register' => '../views/pages/register.php',
    'create' => '../views/pages/create_post.php',
    'edit' => '../views/pages/edit_post.php',
    'post' => '../views/pages/blog_post.php',
];

$request = $_GET['pages'] ?? 'home';
$templates = $pages[$request] ?? null;
?>


<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>php-blog - Home</title>
</head>
<body class="grid grid-rows-[auto_1fr_auto] min-h-full">
<?php include "../views/components/navbar.php"; ?>
<main>

    <?php if ($templates): ?>
        <?php include $templates; ?>
    <?php else: ?>
        <h1>404 - Not found</h1>
    <?php endif; ?>
</main>

<?php include "../views/components/footer.php"; ?>

</body>
</html>
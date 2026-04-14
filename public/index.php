<?php

require_once __DIR__ . '/../vendor/autoload.php';

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

$pdo = require __DIR__ . '/../config/db.php';
$error_message = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_GET['pages'] === 'create') {

        $title = $_POST['title'];
        $content = $_POST['content'];
        $image = $_POST['image'];
        $date = date('Y-m-d');
        $user_id = 1;

        if (!empty($title) && !empty($content) && !empty($user_id) && !empty($date)) {

            $sql = "insert into posts(title, content, image, created_at, user_id) values(:title, :content, :image, :created_at, :user_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                    'title' => $title,
                    'content' => $content,
                    'image' => $image,
                    'created_at' => $date,
                    'user_id' => $user_id
            ]);
        } else {
            $error_message = 'Please fill in all the required fields.';
        }
    }
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
    <?php if (isset($error_message)): ?>
        <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
            <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

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
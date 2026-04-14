<?php

session_start();

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

// Post
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $request === 'create') {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = date('Y-m-d');
    $user_id = 1;
    $fileName = null;


// File validation
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedMimes = ['image/jpeg', 'image/png'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->file($_FILES['image']['tmp_name']);
        
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (!in_array($detectedMime, $allowedMimes)) {
            $error_message = "Invalid file type : " . $detectedMime;
        } elseif (!in_array($fileExtension, $allowedExtensions)) {
            $error_message = "Invalid file extension : ." . $fileExtension;
        } else {
            $uploadDir = __DIR__ . '/../public/uploads/';
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                $error_message = 'There was an error uploading your file.';
            }
        }
    }

    // Check if title etc are empty, if not, insert datas
    if (empty($error_message)) {
        if (!empty(trim($title)) && !empty(trim($content)) && !empty($user_id) && !empty($date)) {

            // Insertion following this pattern : request -> preparation -> execution
            $sql = "insert into posts(title, content, image, created_at, user_id) values(:title, :content, :image, :created_at, :user_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                    'title' => $title,
                    'content' => $content,
                    'image' => $fileName,
                    'created_at' => $date,
                    'user_id' => $user_id
            ]);

            // Go back to home once done
            $_SESSION['notification'] = 'Post created !';
            header('Location: ?pages=home');
            exit;
        } else {
            // Error message
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
    <?php if (isset($_SESSION['notification'])): ?>
        <div class='text-green-700 border border-green-500 bg-green-50 rounded-md p-2.5 mb-2.5'>
            <?php echo $_SESSION['notification'];
            unset($_SESSION['notification']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error_message)) : ?>
        <div class="text-red-700 border border-red-500 bg-red-50 rounded-md p-2.5 mb-2.5">
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

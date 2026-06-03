<?php

$pageTitle = $_GET['pages']
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
    <title><?= $pageTitle ?? 'home' ?></title>
</head>
<body class="grid grid-rows-[auto_1fr_auto] min-h-full">
<?php include __DIR__ . '/components/navbar.php'; ?>
<main>
    <?php include __DIR__ . '/components/flash.php'; ?>
    <?= $pageContent ?>
</main>

<?php include __DIR__ . "/components/footer.php"; ?>

</body>
</html>
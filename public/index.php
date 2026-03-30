<?php

?>


<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>My PHP blog</title>
</head>
<body class="grid grid-rows-[auto_1fr_auto] min-h-full">
<header class="flex flex-row row-start-1 justify-between pr-2 pl-2">
    <a href="index.php"><img src="" alt="Blog home"></a>
    <nav>
        <ul class="flex flex-row gap-1">
            <li>Home</li>
            <li>Manage your posts</li>
            <li>Sign up / Log in</li>
        </ul>
    </nav>
</header>

<main class="grid grid-rows-2 grid-cols-3 row-start-2">
    <article class="flex flex-col row-start-1 col-span-full p-4">
        <img alt="Featured article cover">
        <h2>Featured article title</h2>
        <div>
            <span>By Author</span>
            <time datetime="2026-03-23">Mar 23, 2026</time>
        </div>
        <p>Short intro to the featured post.</p>
    </article>

    <section class="flex flex-row row-start-2 col-span-full justify-around self-center p-4">
        <a href="" class="flex flex-col">
            <img src="" alt="Highlight cover">
            <h3>Highlight title 1</h3>
            <p>Quick summary.</p>
        </a>
        <a href="" class="flex flex-col">
            <img src="" alt="Highlight cover">
            <h3>Highlight title 2</h3>
            <p>Quick summary.</p>
        </a>
        <a href="" class="flex flex-col">
            <img src="" alt="Highlight cover">
            <h3>Highlight title 3</h3>
            <p>Quick summary.</p>
        </a>
    </section>
</main>
<footer class="row-start-3 pl-2 pr-2">
    <nav>
        <ul class="flex flex-row gap-1">
            <li>Privacy</li>
            <li>Contact</li>
        </ul>
    </nav>
</footer>
</body>
</html>
<?php

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>My PHP blog</title>
</head>
<body>
<header>
    <a href="index.php"><img src="" alt="Blog home"></a>
    <nav id="menu-nav">
        <ul>
            <li>Home</li>
            <li>Manage your posts</li>
            <li>Sign up / Log in</li>
        </ul>
    </nav>
</header>

<main>
    <article id="main-article">
        <img alt="Featured article cover" id="main-article-cover">
        <h2>Featured article title</h2>
        <div class="post-meta">
            <span class="author">By Author</span>
            <time datetime="2026-03-23">Mar 23, 2026</time>
        </div>
        <p>Short intro to the featured post.</p>
    </article>

    <section id="highligts">
        <a href="" class="highlighted-article">
            <img src="" alt="Highlight cover">
            <h3>Highlight title 1</h3>
            <p>Quick summary.</p>
        </a>
        <a href="" class="highlighted-article">
            <img src="" alt="Highlight cover">
            <h3>Highlight title 2</h3>
            <p>Quick summary.</p>
        </a>
        <a href="" class="highlighted-article">
            <img src="" alt="Highlight cover">
            <h3>Highlight title 3</h3>
            <p>Quick summary.</p>
        </a>
    </section>
</main>
<footer>
    <nav>Privacy | Contact</nav>
</footer>
</body>
</html>
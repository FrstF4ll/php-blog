<?php

?>


<?php include "header.php"; ?>
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
            <a href="blog_post.php" class="flex flex-col">
                <img src="" alt="Highlight cover">
                <h3>Highlight title 1</h3>
                <p>Quick summary.</p>
            </a>
            <a href="blog_post.php" class="flex flex-col">
                <img src="" alt="Highlight cover">
                <h3>Highlight title 2</h3>
                <p>Quick summary.</p>
            </a>
            <a href="blog_post.php" class="flex flex-col">
                <img src="" alt="Highlight cover">
                <h3>Highlight title 3</h3>
                <p>Quick summary.</p>
            </a>
        </section>
    </main>
<?php include "footer.php"; ?>


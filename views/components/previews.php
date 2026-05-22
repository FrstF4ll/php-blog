<?php

$placeholder = "/assets/placeholder.png";
$postImagePath = !empty($post['image']) ? "uploads/" . $post['image'] : $placeholder;

$title = htmlspecialchars($post['title']);
$content = htmlspecialchars($post['content']);
?>

<article id="<?= $post['id'] ?>"
         class="flex max-w-xl flex-col items-start justify-between relative shadow-lg rounded-2xl p-4 bg-white">
    <?php if (isset($show_edit_icon) && $show_edit_icon === true): ?>
        <div class="w-full flex justify-end mb-2">
            <a href="?pages=edit&id=<?= $post['id'] ?>" class="relative z-10">
                <span class="sr-only">Edit post</span>
                <img src="assets/pen.svg" alt="pen"
                     class="h-7 w-7 transition-colors p-1 bg-gray-100 hover:bg-gray-200 rounded-full">
            </a>
        </div>
    <?php endif; ?>
    <img class="rounded-lg w-full object-cover" src="<?= $postImagePath ?>" alt="workflow">

    <div class="flex items-center justify-between w-full mt-4 p-1">
        <div class="flex items-center gap-x-4 text-xs">
            <time datetime="<?= $post['created_at'] ?>" class="text-gray-500"><?= $post['created_at'] ?></time>
            <p class="relative z-10 rounded-full bg-gray-100 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-200 text-indigo-600 hover:text-indigo-700">
                <?= 'Empty category' ?></p>
        </div>
    </div>
    <div class="group relative grow p-2">
        <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
            <a href="?pages=post&id=<?= $post['post_id'] ?>">
                <?= $title ?>
            </a>
        </h3>
        <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600"><?= $content ?></p>
    </div>
    <div class="relative mt-8 flex items-center gap-x-4 justify-self-end p-2">
        <img src="assets/profile.svg" alt="profile picture" class="h-10 w-10 rounded-full bg-gray-200">
        <div class="text-sm/6 ">
            <p class="font-semibold text-gray-900">
                <a href="#">
                    <span class="absolute inset-0"></span>
                    <?= $post['author_name'] ?? 'Deleted user' ?>
                </a>
            </p>
        </div>
    </div>
</article>

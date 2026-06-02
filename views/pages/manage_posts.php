<?php
$isAdmin = isset($_SESSION['role_id']) && (int)$_SESSION['role_id'] === 2;
?>

<div class="px-6 py-12 lg:px-8 max-w-7xl mx-auto">
    <div class="border-b border-gray-900/10 pb-12 mb-12 flex justify-between items-center">
        <h2 class="text-3xl font-semibold text-gray-900"><?= $isAdmin ? 'All Posts (Admin)' : 'Manage your posts' ?></h2>
        <a href="?pages=create"
           class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Create new post
        </a>
    </div>

    <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
        <?php $show_edit_icon = true; ?>
        <?php foreach (array_reverse($posts) as $post): ?>
            <?php if ($isAdmin || (int)$post['user_id'] === (int)$_SESSION['id']): ?>
                <?php include "../views/components/previews.php"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

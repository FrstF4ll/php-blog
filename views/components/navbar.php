<?php
$base_link = "rounded-md py-2 px-3 text-sm font-medium";
$link_state = [
        'inactive' => "text-gray-300 hover:bg-white/5 hover:text-white",
        'active' => "bg-gray-900 text-white",
];
?>


<nav class="relative bg-gray-900">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <a href="?pages=home"><img
                                src="assets/logo.svg"
                                alt="Your Company" class="h-8 w-auto"/>
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="?pages=home" aria-current="page"
                           class="<?= $base_link ?> <?= $link_state['active'] ?>">Home</a>
                        <a href="<?= empty($_SESSION['id']) ? "?pages=login" : "?pages=create" ?>" class="<?= $base_link ?> <?= $link_state['inactive'] ?>
                        ">Create your
                        own</a>
                        <?php if (!empty($_SESSION['id'])): ?>
                            <a href="?pages=manage" class="<?= $base_link ?> <?= $link_state['inactive'] ?>">Manage your
                                posts
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if (!empty($_SESSION['id'])): ?>
                <form action="?pages=logout" method="POST"
                      class="text-white right-0 flex items-center gap-3 pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <input type="hidden" name="csrf_token"
                           value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                    <p><?= $_SESSION['name'] ?></p>
                    <button type="submit"
                            class="text-sm font-medium text-red-800 bg-red-200 hover:bg-red-100 px-4 py-2 rounded-lg transition-colors">
                        Log out
                    </button>
                </form>
            <?php else: ?>
                <div class="absolute inset-y-0 right-0 flex items-center gap-3 pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <a href="?pages=login"
                       class="text-sm font-medium text-slate-200 hover:text-white px-3.5 py-2 transition-colors">
                        Log in
                    </a>
                    <a href="?pages=register"
                       class="text-sm font-medium text-indigo-800 bg-indigo-200 hover:bg-indigo-100 px-4 py-2 rounded-lg transition-colors">
                        Sign up
                    </a>
                </div>
            <?php endif; ?>
        </div>
</nav>

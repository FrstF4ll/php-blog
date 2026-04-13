<?php
$base_link = "rounded-md py-2 px-3 text-sm font-medium";
$link_state = [
        'inactive' => "text-gray-300 hover:bg-white/5 hover:text-white",
        'active' => "bg-gray-900 text-white",
];
?>


<nav class="relative bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex shrink-0 items-center">
                    <a href="?pages=home"><img
                                src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                                alt="Your Company" class="h-8 w-auto"/>
                    </a>
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <a href="?pages=home" aria-current="page"
                           class="<?= $base_link ?> <?= $link_state['active'] ?>">Home</a>
                        <a href="?pages=create" class="<?= $base_link ?> <?= $link_state['inactive'] ?>">Create your
                            own</a>
                        <a href="?pages=edit" class="<?= $base_link ?> <?= $link_state['inactive'] ?>">Manage your
                            posts
                        </a>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center gap-3 pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                <a href="?pages=login"
                   class="text-sm font-medium text-slate-200 hover:text-white px-3.5 py-2 transition-colors">
                    Log in
                </a>
                <a href="?pages=register"
                   class="text-sm font-medium text-blue-800 bg-blue-200 hover:bg-blue-100 px-4 py-2 rounded-lg transition-colors">
                    Sign up
                </a>
            </div>
        </div>
</nav>

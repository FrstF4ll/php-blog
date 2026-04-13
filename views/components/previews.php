<?php


?>

<article class="flex max-w-xl flex-col items-start justify-between relative">
    <div class="flex items-center justify-between w-full">
        <div class="flex items-center gap-x-4 text-xs">
            <time datetime="2020-03-16" class="text-gray-500">Mar 16, 2020</time>
            <p
               class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">Marketing</p>
        </div>

        <?php if (isset($show_edit_icon) && $show_edit_icon === true): ?>
        <a href="?pages=edit" class="relative z-10 text-gray-400 hover:text-indigo-600 transition-colors p-1">
            <span class="sr-only">Edit post</span>
            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path d="M2.695 14.763l-1.262 3.152a.5.5 0 00.65.65l3.152-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z" />
            </svg>
        </a>
        <?php endif; ?>
    </div>
    <div class="group relative grow">
        <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
            <a href="?pages=post">
                <span class="absolute inset-0"></span>
                Boost your conversion rate
            </a>
        </h3>
        <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">Illo sint voluptas. Error voluptates culpa eligendi. Hic
            vel totam vitae illo. Non aliquid explicabo necessitatibus unde. Sed exercitationem placeat consectetur
            nulla deserunt vel. Iusto corrupti dicta.</p>
    </div>
    <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
        <div class="text-sm/6">
            <p class="font-semibold text-gray-900">
                <a href="#">
                    <span class="absolute inset-0"></span>
                    Michael Foster
                </a>
            </p>
            <p class="text-gray-600">Co-Founder / CTO</p>
        </div>
    </div>
</article>

<?php

use Frstf4ll\PhpBlog\PostDTO;

$container = require dirname(__DIR__, 2) . '/config/bootstrap.php';

$pageController = $container['PageController'];
$postController = $container['PostController'];

if (!$post) {
    $pageController->not_found();
    return;
}

$data = new PostDTO(
        title: $_POST['title'] ?? $post->title,
        content: $_POST['content'] ?? $post->content,
        created_at: $post->created_at,
        user_id: $post->user_id,
        image: $post->image,
        id: $post->id
);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $postController->editPost($data, $_FILES['image'] ?? null);
    $error_message = $postController->handleResultRedirect($result, '?pages=manage');
}

$title = htmlspecialchars($data->title);
$content = htmlspecialchars($data->content);
$image = $data->image;
$placeholder = "/assets/placeholder.png";
$postImagePath = !empty($image) ? "uploads/" . $image : $placeholder;
?>

<form method="POST" enctype="multipart/form-data" class="flex flex-col p-8 text-gray-900 ">
    <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-3xl font-semibold text-center">Edit your article</h2>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="title" class=" text-sm/6 font-medium">Title</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="title" placeholder="Your Article..." value="<?= $title ?>"
                                   class="w-full grow bg-white py-1.5 pr-3 pl-1 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"/>
                        </div>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="about" class=" text-sm/6 font-medium">Content</label>
                    <div class="mt-2">
                        <textarea id="content" name="content" rows="8"
                                  class="w-full rounded-md px-3 py-1.5  outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"><?= trim($content) ?></textarea>
                    </div>
                </div>
                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Cover photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <img src="/assets/layout.svg" class="mx-auto size-12 text-gray-300" alt="Layout icon">
                            <div class="mt-4 flex text-sm/6 text-gray-600">
                                <label for="image-upload"
                                       class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="image-upload" type="file" name="image" accept="image/png, image/jpeg"
                                           class="sr-only"/>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG up to 10MB</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button"
                        class="rounded-md border border-gray-400 px-3 py-2 text-sm shadow-sm hover:bg-gray-200 font-semibold">
                    Cancel
                </button>
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Save
                </button>
            </div>
        </div>
</form>


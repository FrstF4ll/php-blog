<?php

?>

<form method="POST" class="flex flex-col p-8">
    <div class="space-y-12">

        <div class="border-b border-gray-900/10 pb-12">
            <h2 class="text-3xl font-semibold text-gray-900 text-center">Create your article</h2>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                <div class="sm:col-span-4">
                    <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                    <div class="mt-2">
                        <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                            <input type="text" name="title" placeholder="Your Article..."
                                   class="block min-w-0 w-full grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" required />
                        </div>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="about" class="block text-sm/6 font-medium text-gray-900">Content</label>
                    <div class="mt-2">
                        <textarea name="content" rows="3"
                                  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required></textarea>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Cover photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                        <div class="text-center">
                            <img src="/assets/layout.svg" class="mx-auto size-12 text-gray-300" alt="Layout icon">
                            <div class="mt-4 flex text-sm/6 text-gray-600">
                                <label for="image"
                                       class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                    <span>Upload a file</span>
                                    <input type="file" name="image" class="sr-only"/>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
                <button type="button" class="rounded-md border-1 border-gray-400 px-3 py-2 text-sm shadow-sm hover:bg-gray-200 font-semibold text-gray-900">Cancel</button>
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Publish
                </button>
            </div>

        </div>
</form>

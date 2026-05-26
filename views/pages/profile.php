<?php ?>

<form class="flex flex-col p-14">
    <h2 class="text-base/7 font-semibold text-gray-900">Profile</h2>
    <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful what you
        share.</p>
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
            <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input id="username" type="text" name="username" placeholder="janesmith"
                           class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"/>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
            <div class="mt-2">
                <input id="email" type="email" name="email" autocomplete="email"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
            </div>
            <p class="mt-1 text-sm/6 text-gray-600">Use a permanent address where you can receive mail.</p>
        </div>
    </div>
</form>


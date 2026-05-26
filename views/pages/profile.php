<?php
$username = htmlspecialchars($user->name);
$email = htmlspecialchars($user->email);

?>

<form class="flex flex-col p-14" method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
    <h2 class="text-base/7 font-semibold text-gray-900">Profile</h2>
    <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful what you
        share.</p>
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <label for="name" class="block text-sm/6 font-medium text-gray-900">Username</label>
            <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input id="name" type="text" name="name" value="<?= $username ?>"
                           class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"/>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>

            <div class="mt-2">
                <input id="email" type="email" name="email" autocomplete="email" value="<?= $email ?>"
                       class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
            </div>
        </div>
    </div>
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
            <label for="password" class="block text-sm/6 font-medium text-gray-900">Password  <span
                        class="mt-1 text-sm/6 text-red-400">*At least 8 characters long with number, upper and lowercases</span></label>
            <div class="mt-2">
                <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                    <input id="password" type="password" name="password"
                           class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"/>
                </div>
            </div>
        </div>
    </div>
    <button type="submit"
            class="mt-8 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Save
    </button>
</form>


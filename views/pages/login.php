<?php

$container = require dirname(__DIR__, 2) . '/config/bootstrap.php';
$userController = $container['UserController'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $userController->authenticateSession($_POST);
    if ($result['success']) {
        $_SESSION['notification'] = $result['message'];
        header("Location: ?pages=login");
        exit;
    }
    $_SESSION['error_message'] = $result['message'];
}

?>
<?php if (!empty($_SESSION['error_message'])) : ?>
    <div class="text-red-700 border border-red-500 bg-red-50 rounded-md p-2.5 mb-2.5">
        <?php echo htmlspecialchars($_SESSION['error_message']);
        unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img src="assets/favicon.svg" alt="Logo"
             class="mx-auto h-10 w-auto"/>
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form enctype="application/x-www-form-urlencoded" method="POST" class="space-y-6">
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                <div class="mt-2">
                    <input id="email" type="email" name="email" required autocomplete="email"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="text-sm">
                        <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
                    </div>
                </div>
                <div class="mt-2">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
                </div>
            </div>

            <div>
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sign in
                </button>
            </div>
            <div>
                <a href="?pages=register"
                   class="flex w-full justify-center rounded-md border-2 border-gray-300 text-indigo-500 px-3 py-1.5 text-sm/6 font-semibold bg-white shadow-xs hover:bg-gray-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ">
                    Create a new account ?
                </a>
            </div>
        </form>
    </div>
</div>

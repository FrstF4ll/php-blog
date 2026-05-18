<?php

$register_fields = [
        ['id' => 'username', 'label' => 'Username', 'type' => 'text', 'name' => 'name'],
        ['id' => 'email', 'label' => 'Email address', 'type' => 'email', 'name' => 'email'],
        ['id' => 'password', 'label' => 'Password', 'type' => 'password', 'name' => 'password'],
        ['id' => 'password_confirm', 'label' => 'Confirm Password', 'type' => 'password', 'name' => 'password_confirm'],
];

$container = require dirname(__DIR__, 2) . '/config/bootstrap.php';
$userController = $container['UserController'];

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
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create a new account </h2>
    </div>
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form method="POST" enctype="application/x-www-form-urlencoded" class="space-y-6">
            <div class="space-y-4">
                <?php foreach ($register_fields as $field): ?>
                    <?php
                    $input_id = $field['id'];
                    $input_label = $field['label'];
                    $input_type = $field['type'];
                    $input_name = $field['name'];

                    include __DIR__ . "/../components/input_field.php";
                    ?>
                <?php endforeach; ?>

                <div class="mt-8 flex flex-col gap-4">
                    <button type="submit"
                            class="flex w-full justify-center rounded-md border-2 border-indigo-400 text-black px-3 py-1.5 text-sm/6 font-semibold bg-white shadow-xs hover:bg-gray-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ">
                        Register
                    </button>
                </div>
            </div>
            <div>
                <a href="?pages=login"
                   class="flex w-full justify-center rounded-md border-2 border-gray-300 text-indigo-500 px-3 py-1.5 text-sm/6 font-semibold bg-white shadow-xs hover:bg-gray-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ">
                    Already have an account?
                </a>
            </div>
        </form>
    </div>
</div>


<?php if (isset($_SESSION['flash'])):
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    $error_color = 'text-red-700 border border-red-500 bg-red-50';
    $success_color = 'text-green-700 border border-green-500 bg-green-50';

    $isSuccess = ($flash['type'] === 'success');
    $colors = $isSuccess ? $success_color : $error_color;
    ?>
    <div class='<?= $colors ?> rounded-md p-2.5 mb-2.5'>
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>
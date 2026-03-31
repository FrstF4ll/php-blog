<?php
// Fallbacks just in case the variables aren't set
$input_id = $input_id ?? 'default_id';
$input_name = $input_name ?? $input_id;
$input_type = $input_type ?? 'text';
$input_label = $input_label ?? 'Default Label';
$input_required = $input_required ?? true;
?>

<div>
    <label for="<?= htmlspecialchars($input_id) ?>" class="block text-sm/6 font-medium text-gray-900">
        <?= htmlspecialchars($input_label) ?>
    </label>
    <div class="mt-2">
        <input id="<?= htmlspecialchars($input_id) ?>"
               type="<?= htmlspecialchars($input_type) ?>"
               name="<?= htmlspecialchars($input_name) ?>"
                <?= $input_required ? 'required' : '' ?>
               autocomplete="<?= htmlspecialchars($input_id) ?>"
               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"/>
    </div>
</div>

<?php

?>

<?php include "header.php" ?>
<form class="flex flex-col gap-1 p-10">
    <label for="title">Title</label>
    <input class="border-2" type="text" name="title">
    <label for="picture">Cover image</label>
    <input class="flex flex-grow border-2" type="file" name="picture">
    <label for="content">Content</label>
    <textarea class="flex flex-grow border-2"></textarea>
    <input class="border-2" type="submit" value="Publish">
</form>
<?php include "footer.php" ?>

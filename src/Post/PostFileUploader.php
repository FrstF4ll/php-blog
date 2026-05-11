<?php

namespace Frstf4ll\PhpBlog\Post;

class PostFileUploader
{
    public function __construct(public string $uploadDir = __DIR__ . '/../../public/uploads')
    {
    }

    public function upload($file)
    {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'fileName' => null];
        }

        $fileName = time() . '_' . basename($file['name']);
        $uploadPath = $this->uploadDir . '/' . $fileName;
        if (!is_dir($this->uploadDir)) mkdir($this->uploadDir, 0755, true);
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return ['success' => true, 'fileName' => $fileName];
        }
        return ['success' => false, 'fileName' => null];
    }
}
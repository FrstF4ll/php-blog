<?php

namespace Frstf4ll\PhpBlog\Post;

use Frstf4ll\PhpBlog\ServiceException;

class PostFileUploader
{
    public function __construct(public string $uploadDir = __DIR__ . '/../../public/uploads')
    {
    }

    public function upload($file): ?string
    {
        if ($file === null || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new ServiceException("Upload failed with error code: " . $file['error']);
        }

        $fileName = bin2hex(random_bytes(8)) . '_' . basename($file['name']);
        $uploadPath = $this->uploadDir . '/' . $fileName;
        if (!is_dir($this->uploadDir)) mkdir($this->uploadDir, 0755, true);
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            return $fileName;
        }
        throw new ServiceException('Server failed save your image');
    }
}
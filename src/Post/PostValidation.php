<?php

namespace Frstf4ll\PhpBlog\Post;

use Frstf4ll\PhpBlog\ServiceException;

class PostValidation
{

    private function validateField($title, $content, $user_id, $date)
    {
        if (empty(trim($title)) || empty(trim($content)) || empty($user_id) || empty($date)) {
            throw new ServiceException('Please fill in all the required fields.');
        }
    }

    private function validateFileType($file)
    {
        if ($file === null || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new ServiceException("File upload error : " . $file['error']);
        }

        $detectedExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (!in_array($detectedExtension, $allowedExtensions)) {
            throw new ServiceException("Unsupported file extension : " . $detectedExtension);
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->file($file['tmp_name']);
        $allowedMimes = ['image/jpeg', 'image/png'];
        if (!in_array($detectedMime, $allowedMimes)) {
            throw new ServiceException("Unsupported file type : " . $detectedMime);
        }
    }

    public function validation($title, $content, $user_id, $date, $file): void
    {
        $this->validateField($title, $content, $user_id, $date);
        $this->validateFileType($file);
    }
}

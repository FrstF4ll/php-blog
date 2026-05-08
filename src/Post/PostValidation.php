<?php

namespace Frstf4ll\PhpBlog\Post;

class PostValidation
{
    private function success()
    {
        return ['valid' => true, 'message' => null];
    }

    private function failure($message)
    {
        return ['valid' => false, 'message' => $message];
    }

    private function validateField($title, $content, $user_id, $date)
    {
        if (empty(trim($title)) || empty(trim($content)) || empty($user_id) || empty($date)) {
            return $this->failure('Please fill in all the required fields.');
        }
        return $this->success();
    }


    private function validateFileType($file)
    {
        if ($file === null || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return $this->success();
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return $this->failure("File upload error : " . $file['error']);
        }

        $detectedExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if(!in_array($detectedExtension, $allowedExtensions)) {
            return $this->failure("Unsupported file extension : " . $detectedExtension);
        }

        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $detectedMime = $finfo->file($file['tmp_name']);
        $allowedMimes = ['image/jpeg', 'image/png'];
        if (!in_array($detectedMime, $allowedMimes)) {
            return $this->failure("Unsupported file type : " . $detectedMime);
        }
        return $this->success();
    }

    public function validation($title, $content, $user_id, $date, $file)
    {
        $validateField = $this->validateField($title, $content, $user_id, $date);
        if (!$validateField['valid']) {
            return $validateField;
        }
        $validateFileType = $this->validateFileType($file);
        return $validateFileType;
    }
}

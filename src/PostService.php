<?php

namespace Frstf4ll\PhpBlog;

class PostService
{
    public function __construct(
        private readonly PostValidation $validator,
        private readonly PostRepository $repository
    )
    {
    }

    public function create($title, $content, $user_id, $date)
    {
        $fileName = null;
        $validation = $this->validator->validation($title, $content, $user_id, $date, $_FILES['image'] ?? null);

        if (!$validation['valid']) {
            return ['success' => false, 'error' => $validation['message']];
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $uploadDir = __DIR__ . '/../public/uploads/';
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName);
        }

        $requestDTO = new PostDTO($title, $content, $date, $user_id, $fileName);
        $this->repository->createPost($requestDTO);

        return ['success' => true, 'message' => 'Post created!'];
    }
}

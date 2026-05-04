<?php

namespace Frstf4ll\PhpBlog;

class PostService
{
    public function __construct(
        private readonly PostValidation   $validator,
        private readonly PostRepository   $repository,
        private readonly PostFileUploader $fileUploader
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

        if (isset($_FILES['image'])) {
            $uploadResult = $this->fileUploader->upload($_FILES['image']);
            if ($uploadResult['success']) {
                $fileName = $uploadResult['fileName'];
            }
        }

        $requestDTO = new PostDTO($title, $content, $date, $user_id, $fileName);
        $this->repository->createPost($requestDTO);

        return ['success' => true, 'message' => 'Post created!'];
    }

    public function getAll()
    {
        return $this->repository->getAllPosts();

    }

    public function getSingle($postId){
        return $this->repository->getSinglePost($postId);
    }

    public function update(PostDTO $dto){
        return $this->repository->updatePost($dto);
    }
}

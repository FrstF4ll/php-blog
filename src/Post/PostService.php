<?php

namespace Frstf4ll\PhpBlog\Post;

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

    public function update(PostDTO $dto, $file)
    {
        $fileName = $dto->image;

        $validation = $this->validator->validation(
            $dto->title,
            $dto->content,
            $dto->user_id,
            $dto->created_at,
            $file
        );

        if (!$validation['valid']) {
            return ['success' => false, 'error' => $validation['message']];
        }

        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            $upload = $this->fileUploader->upload($file);
            if ($upload['success']) {
                $fileName = $upload['fileName'];
            }
        }

        $updated = new PostDTO(title: $dto->title, content: $dto->content, created_at: $dto->created_at, user_id: $dto->user_id, image: $fileName, id: $dto->id);
        $this->repository->updatePost($updated);

        return ['success' => true, 'message' => 'Post updated!'];
    }

    public function getAll()
    {
        return $this->repository->getAllPosts();

    }

    public function getSingle($postId)
    {
        return $this->repository->getSinglePost($postId);
    }


}

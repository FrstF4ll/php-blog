<?php

namespace Frstf4ll\PhpBlog\Post;

use Frstf4ll\PhpBlog\ServiceException;

class PostService
{
    public function __construct(
        private readonly PostValidation   $validator,
        private readonly PostRepository   $repository,
        private readonly PostFileUploader $fileUploader
    )
    {
    }


    public function create($title, $content, $user_id, $date, ?array $image = null)
    {
        $fileName = null;
        $this->validator->validation($title, $content, $user_id, $date, $image);


        if ($image && $image['error'] !== UPLOAD_ERR_NO_FILE) {
            $image = $this->fileUploader->upload($image);
            if ($image) {
                $fileName = $image;
            }
        }

        $requestDTO = new PostDTO($title, $content, $date, $user_id, $fileName);
        $this->repository->insertPost($requestDTO);
    }

    public function update(PostDTO $dto, $file)
    {
        $fileName = $dto->image;

        $this->validator->validation(
            $dto->title,
            $dto->content,
            $dto->user_id,
            $dto->created_at,
            $file
        );

        if ($file && $file['error'] !== UPLOAD_ERR_NO_FILE) {
            $file = $this->fileUploader->upload($file);
            if ($file) {
                $fileName = $file;
            }
        }

        $updated = new PostDTO(title: $dto->title, content: $dto->content, created_at: $dto->created_at, user_id: $dto->user_id, image: $fileName, id: $dto->id);
        $this->repository->updatePost($updated);
    }

    public function getAll()
    {
        return $this->repository->getAllPosts();

    }

    public function getSingle($postId): PostDTO
    {
        return $this->repository->selectSinglePost($postId);
    }


}

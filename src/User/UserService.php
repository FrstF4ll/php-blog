<?php

namespace Frstf4ll\PhpBlog\User;

use Frstf4ll\PhpBlog\Post\PostRepository;

class UserService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function register($name, $email, $password)
    {
        //     $fileName = null;
//        $validation = $this->validator->validation($title, $content, $user_id, $date, $_FILES['image'] ?? null);

        /*      if (!$validation['valid']) {
                  return ['success' => false, 'error' => $validation['message']];
              } */

        $password = password_hash($password, PASSWORD_DEFAULT);
        $requestDTO = new UserDTO($name, $email, $password);
        $this->repository->createUser($requestDTO);

        return ['success' => true, 'message' => 'Account created successfully, please, log in'];
    }

}
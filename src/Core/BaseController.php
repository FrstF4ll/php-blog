<?php

namespace Frstf4ll\PhpBlog\Core;

abstract class BaseController

{
    protected array $viewData = [];

    public function setViewData(array $data): void
    {
        $this->viewData = array_merge($this->viewData, $data);
    }

    private function flash(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }

    private function redirect(string $url): void
    {
        header("Location: $url");
        exit;
    }

    protected function flashAndRedirect(string $type, string $message, string $url): void
    {
        $this->flash($type, $message);
        $this->redirect($url);
    }
}
<?php
class View
{
    public static function render(string $view, array $data = []): void
    {
        extract($data);
        $viewFile = BASE_PATH . '/app/views/' . $view . '.php';
        ob_start();
        require $viewFile;
        $content = ob_get_clean();
        require BASE_PATH . '/app/views/layout/base.php';
    }

    public static function partial(string $view, array $data = []): void
    {
        extract($data);
        require BASE_PATH . '/app/views/' . $view . '.php';
    }

    public static function asset(string $path): string
    {
        return BASE_URL . '/assets/' . ltrim($path, '/');
    }

    public static function route(string $path): string
    {
        return BASE_URL . '/' . ltrim($path, '/');
    }
}

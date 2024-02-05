<?php

namespace app\framework\classes;

use Exception;

class Engine
{
    public function render(string $viewName, array $data)
    {

        $viewPath = dirname(__FILE__, 2) . "/resources/views/{$viewName}.php";

        if (!file_exists($viewPath)) {
            throw new Exception("The view '{$viewName}' does not exist.");
        }

        ob_start();

        extract($data);
        require $viewPath;

        $content = ob_get_contents();

        ob_end_clean();

        return $content;
    }
}

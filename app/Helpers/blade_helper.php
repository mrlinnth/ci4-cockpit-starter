<?php

use App\Libraries\BladeView;

if (!function_exists('blade')) {
    /**
     * Get the BladeView instance
     *
     * @return BladeView
     */
    function blade(): BladeView
    {
        static $blade;

        if ($blade === null) {
            $blade = new BladeView();
        }

        return $blade;
    }
}

if (!function_exists('view_blade')) {
    /**
     * Render a Blade view
     *
     * This is a shortcut function for rendering Blade views
     *
     * @param string $view View name (without .blade.php extension)
     * @param array $data Data to pass to the view
     * @return string Rendered view content
     */
    function view_blade(string $view, array $data = []): string
    {
        return blade()->render($view, $data);
    }
}

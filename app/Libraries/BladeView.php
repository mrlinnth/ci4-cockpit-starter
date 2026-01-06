<?php

namespace App\Libraries;

use Jenssegers\Blade\Blade;

/**
 * BladeView Library
 *
 * Integrates Laravel Blade templating engine with CodeIgniter 4
 *
 * @package App\Libraries
 */
class BladeView
{
    /**
     * Blade instance
     *
     * @var Blade
     */
    protected $blade;

    /**
     * Views directory path
     *
     * @var string
     */
    protected $viewsPath;

    /**
     * Cache directory path
     *
     * @var string
     */
    protected $cachePath;

    /**
     * Constructor
     */
    public function __construct()
    {
        // Set views and cache paths
        $this->viewsPath = APPPATH . 'Views';
        $this->cachePath = WRITEPATH . 'cache/blade';

        // Create cache directory if it doesn't exist
        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0755, true);
        }

        // Initialize Blade
        $this->blade = new Blade($this->viewsPath, $this->cachePath);
    }

    /**
     * Render a Blade view
     *
     * @param string $view View name (without .blade.php extension)
     * @param array $data Data to pass to the view
     * @return string Rendered view content
     */
    public function render(string $view, array $data = []): string
    {
        return $this->blade->render($view, $data);
    }

    /**
     * Make a Blade view (returns View instance for chaining)
     *
     * @param string $view View name (without .blade.php extension)
     * @param array $data Data to pass to the view
     * @return \Illuminate\View\View
     */
    public function make(string $view, array $data = [])
    {
        return $this->blade->make($view, $data);
    }

    /**
     * Get the Blade instance
     *
     * @return Blade
     */
    public function getBlade(): Blade
    {
        return $this->blade;
    }

    /**
     * Add a custom Blade directive
     *
     * @param string $name Directive name
     * @param callable $handler Directive handler
     * @return void
     */
    public function directive(string $name, callable $handler): void
    {
        $this->blade->directive($name, $handler);
    }

    /**
     * Clear the Blade cache
     *
     * @return void
     */
    public function clearCache(): void
    {
        $files = glob($this->cachePath . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }
}

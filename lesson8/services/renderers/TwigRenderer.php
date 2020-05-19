<?php

namespace App\services\renderers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRenderer implements IRenderer
{
    private $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader([
            dirname(__DIR__, 2) . '/views/',
            dirname(__DIR__, 2) . '/views/layouts/'
        ]);

        $this->twig = new Environment(
            $loader,
            [
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function render($template, $params = []) {
        $template .= '.twig';

        try {
            $content = $this->twig->render($template, $params);
        } catch (\Exception $exception) {
            $content = 'Не верное работа рендеринга';
        }
        return $content;
    }
}

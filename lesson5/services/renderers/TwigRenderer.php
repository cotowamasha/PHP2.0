<?php

namespace App\services\renderers;

class TwigRenderer implements IRenderer
{
    public function render($template, $params = []) {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl('layouts/main', ['content' => $content]);
    }

    protected function renderTmpl($template, $params = [])
    {
        $loader1 = new \Twig\Loader\ArrayLoader([
            dirname(__DIR__, 2) . '/views/layouts/main.twig' => '',
        ]);
        $loader2 = new \Twig\Loader\ArrayLoader([
            dirname(__DIR__, 2) . '/views/userAll.twig' => ''
        ]);
        $loader = new \Twig\Loader\ChainLoader([$loader1, $loader2]);
        $twig = new \Twig\Environment($loader);

        echo $twig->render(dirname(__DIR__, 2). '/views/layouts/main.twig');
    }
}

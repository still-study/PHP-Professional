<?php


namespace app\engine;


use app\interfaces\IRenderer;


class TwigRender implements IRenderer
{


    public function renderTemplate($template, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../TwigTemplates');
        $twig = new \Twig\Environment($loader);
        return $twig->render($template . '.twig', $params);
    }
}
<?php


namespace app\controllers;

use app\engine\App;
use app\interfaces\IRenderer;

class Controller
{
    protected $action;
    protected $defaultAction = 'index';
    protected $layout = 'main';
    protected $useLayout = true;
    protected $renderer;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public function runAction($action = null)
    {

        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die('Экшн не сушествует');
        }
    }

    public function render($template, $params = [])
    {
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', [
                    'userName' => App::call()->userRepository->getName(),
                    'auth' => App::call()->userRepository->isAuth(),
                    'isAdmin' => App::call()->userRepository->isAdmin(),
                    'classMenu' => App::call()->userRepository->classMenu(),
                    'count' => App::call()->basketRepository->getTotalQuantity(session_id()),
                    'sum' => App::call()->basketRepository->getTotalSum(session_id())
                ]),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else return $this->renderTemplate($template, $params);
    }


    public function renderTemplate($template, $params = [])
    {
        return $this->renderer->renderTemplate($template, $params);
    }
}
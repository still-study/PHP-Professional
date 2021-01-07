<?php


namespace app\engine;

use app\models\repositories\BasketRepository;
use app\models\repositories\ProductRepository;
use app\models\repositories\UserRepository;
use app\models\repositories\FeedbackRepository;
use app\models\repositories\OrderRepository;
use app\traits\TSingleton;

/**
 * Class App
 * @property Request $request
 * @property Session $session
 * @property BasketRepository $basketRepository
 * @property ProductRepository $productRepository
 * @property UserRepository $userRepository
 * @property FeedbackRepository $feedbackRepository
 * @property Db $db
 * @property OrderRepository $orderRepository
 * @property OrderProductRepository $orderProductRepository
 */
class App
{
    use TSingleton;

    public $config;
    private $components;

    private $controller;
    private $action;

    public function run($config)
    {
        $this->config = $config;
        $this->components = new Storage();
        $this->runController();
    }

    public function runController()
    {
        $this->controller = $this->request->getControllerName() ?: 'product';
        $this->action = $this->request->getActionName();

        $controllerClass = $this->config['controllers_namespaces'] . ucfirst($this->controller) . "Controller";

        if (class_exists($controllerClass)) {
            $controller = new $controllerClass(new TwigRender());
            $controller->runAction($this->action);
        } else {
            echo "Не правильный конроллер";
        }
    }

    /**
     * @return static
     */
    public static function call()
    {
        return static::getInstance();
    }

    //создание компонента при обращении, возвращает объект для хранилища
    public function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            $params = $this->config['components'][$name];
            $class = $params['class'];
            if (class_exists($class)) {
                unset($params['class']);
                //Воспользуемся библиотекой ReflectionClass для создания класса
                //просто return new $class нельзя
                //т.к. не будут переданы параметры для конструктора
                $reflection = new \ReflectionClass($class);
                return $reflection->newInstanceArgs($params);

            }
        }
        return null;
    }

    //чтобы обращаться к компонентам как к свойствам, переопределим геттер
    public function __get($name)
    {
        return $this->components->get($name);
    }

}
<?php


namespace app\controllers;


use app\engine\Request;
use app\models\repositories\BasketRepository;
use app\models\entities\Basket;

class BasketController extends Controller
{
    public function actionIndex() {

        echo $this->render('basket', [
            'basket' => (new BasketRepository())->getBasket(session_id())
        ]);
    }

    public function actionAdd() {
        $id = (new Request())->getParams()['id'];

        $basket = new Basket(session_id(), $id);

        (new BasketRepository())->save($basket);
        $response = [
            'count' => (new BasketRepository())->getCountWhere('session_id', session_id())
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        var_dump($response);
    }

    public function actionDelete() {
        $id = (new Request())->getParams()['id'];
        $session = session_id();
        $basket = (new BasketRepository())->getOne($id);
        $error = 0;
        if ($session == $basket->session_id) {
            (new BasketRepository())->delete($basket);
        } else {
            $error = 1;
        }
        $response = [
            'count' => (new BasketRepository())->getCountWhere('session_id', session_id()),
            'error' => $error

        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
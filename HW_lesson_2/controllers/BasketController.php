<?php


namespace app\controllers;

use app\engine\App;
use app\models\entities\Basket;

class BasketController extends Controller
{
    public function actionIndex() {

        echo $this->render('basket', [
            'basket' => App::call()->basketRepository->getBasket(session_id())
        ]);
    }

    public function actionAdd() {
        $id = App::call()->request->getParams()['id'];

        $repos = App::call()->basketRepository;
        $basketItem = $repos->getBasketItem('product_id', $id);
        $quantity = $basketItem->quantity;

        if (is_null($quantity)) {
            $quantity = 1;
            $basket = new Basket(session_id(), $id, $quantity); //это не компонент ситемы а сущность
            $repos->save($basket);
        } else {
            $basketItem->quantity += 1;

            $repos->save($basketItem);
        }

        $response = [
            'count' => App::call()->basketRepository->getTotalQuantity(session_id()),
            'sum' => App::call()->basketRepository->getTotalSum(session_id())
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionDelete() {
        $id = App::call()->request->getParams()['id'];
        $repos = App::call()->basketRepository;
        $basketItem = $repos->getOne($id);
        $quantity = (int)$basketItem->quantity;
        $session_id = session_id();
        $error = 0;

        if ($session_id == $basketItem->session_id) {
            if ($quantity > 1) {
                $basketItem->quantity -= 1;
                $repos->save($basketItem);
            } else {
                $repos->delete($basketItem);
            }
        } else {
            $error = 1;
        }

        $response = [
            'count' => App::call()->basketRepository->getTotalQuantity(session_id()),
            'sum' => App::call()->basketRepository->getTotalSum(session_id()),
            'quantity' => App::call()->basketRepository->getOne($id)->quantity,
            'price' => App::call()->basketRepository->getBasketPrice($id),
            'error' => $error
        ];
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
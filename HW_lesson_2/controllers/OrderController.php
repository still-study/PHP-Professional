<?php


namespace app\controllers;

use app\engine\App;
use app\engine\Session;
use app\models\entities\Order;
use app\models\entities\OrderProduct;
use app\models\repositories\OrderProductRepository;

class OrderController extends Controller
{
    public function actionIndex() {

        echo $this->render('order');
    }

    public function actionCheck() {
        $firstName = App::call()->request->getParams()['firstName'];
        $lastName = App::call()->request->getParams()['lastName'];
        $address = App::call()->request->getParams()['address'];
        $tel = App::call()->request->getParams()['tel'];
        echo $this->render('orderCheck', [
            'basket' => App::call()->basketRepository->getBasket(session_id()),
            'firstName' => $firstName,
            'lastName' => $lastName,
            'address' => $address,
            'tel' => $tel,
            'total' => App::call()->basketRepository->getTotalSum(session_id())
        ]);
    }

    public function actionCreate()
    {
        $firstName = App::call()->request->getParams()['firstName'];
        $lastName = App::call()->request->getParams()['lastName'];
        $address = App::call()->request->getParams()['address'];
        $tel = App::call()->request->getParams()['tel'];

        $order = (new Order($firstName, $lastName, $address, $tel));
        App::call()->orderRepository->save($order);

        $basket = App::call()->basketRepository->getBasket(session_id());
        foreach ($basket as $item) {
            $orderProduct = (new OrderProduct($order->id, $item['prod_id'], $item['amount'], $item['quantity']));
            (new OrderProductRepository())->save($orderProduct);
        }
        header("location: /" );
        App::call()->session->sessionRegenerate();
    }
}
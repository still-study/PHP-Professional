<?php


namespace app\controllers;

use app\engine\App;
use app\models\repositories\OrderRepository;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $adminOrders = (new OrderRepository())->getAll();

        echo $this->render('admin', [
            'adminOrders' => $adminOrders,
        ]);
    }

    public function actionOrderProducts()
    {
        $id = App::call()->request->getParams()['id'];

//        $orderProducts = (new OrderRepository())->getOrderProducts($id);
//        var_dump($orderProducts);
        $response = [
            'orderProducts' => (new OrderRepository())->getOrderProducts($id),
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    }

}
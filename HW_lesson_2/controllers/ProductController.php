<?php


namespace app\controllers;



use app\engine\Request;
use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = (new Request())->getParams()['page'];
        $catalog = Product::getLimit(($page + 1) * PRODUCT_PER_PAGE);

        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = (new Request())->getParams()['id'];

        echo $this->render('card', [
            'product' => Product::getOne($id)
        ]);
    }

}
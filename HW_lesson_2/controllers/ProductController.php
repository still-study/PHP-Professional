<?php


namespace app\controllers;



use app\models\Product;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $catalog = Product::getAll();
        echo $this->render('catalog', [
            'catalog' => $catalog
        ]);
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];
        echo $this->render('card', [
            'product' => Product::getOne($id)
        ]);
    }

}
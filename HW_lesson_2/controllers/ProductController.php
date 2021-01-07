<?php


namespace app\controllers;


use app\engine\App;

class ProductController extends Controller
{

    public function actionIndex()
    {
        echo $this->render('index');
    }

    public function actionCatalog()
    {
        $page = App::call()->request->getParams()['page'];
        $catalog = App::call()->productRepository->getLimit(($page + 1) * 4);
        echo $this->render('catalog', [
            'catalog' => $catalog,
            'page' => ++$page
        ]);
    }

    public function actionCard()
    {
        $id = App::call()->request->getParams()['id'];

        echo $this->render('card', [
            'product' => App::call()->productRepository->getOne($id)
        ]);
    }

}
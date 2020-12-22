<?php


namespace app\controllers;


use app\models\Feedback;
use app\models\Product;
use app\models\repositories\FeedbackRepository;

class FeedbackController extends Controller
{
    public function actionAll()
    {
        $feedback = (new FeedbackRepository())->getAll();
        echo $this->render('feedback', [
            'feedback' => $feedback
        ]);
    }
}
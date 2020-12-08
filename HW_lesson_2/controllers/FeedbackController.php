<?php


namespace app\controllers;


use app\models\Feedback;
use app\models\Product;

class FeedbackController extends Controller
{
    public function actionAll()
    {
        $feedback = Feedback::getAll();
        echo $this->render('feedback', [
            'feedback' => $feedback
        ]);
    }
}
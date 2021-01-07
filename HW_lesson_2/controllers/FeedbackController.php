<?php


namespace app\controllers;

use app\engine\App;
use app\models\Feedback;
use app\models\Product;

class FeedbackController extends Controller
{
    public function actionAll()
    {
        $feedback = App::call()->feedbackRepository->getAll();
        echo $this->render('feedback', [
            'feedback' => $feedback
        ]);
    }
}
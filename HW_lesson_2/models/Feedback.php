<?php


namespace app\models;


class Feedback extends Model
{

    public $id;
    public $userName;
    public $text;
    public $dateFeed;
    public $goodId;

    protected function getTableName()
    {
        return "Feedback";
    }
}
<?php


namespace app\models;


class Feedback extends DbModel
{

    public $id;
    public $userName;
    public $text;

    protected static function getTableName()
    {
        return "feedback";
    }
}
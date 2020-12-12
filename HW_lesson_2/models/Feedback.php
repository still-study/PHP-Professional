<?php


namespace app\models;


class Feedback extends DbModel
{

    protected $id;
    protected $userName;
    protected $text;

    protected static function getTableName()
    {
        return "feedback";
    }
}
<?php


namespace app\engine;


class Session
{

    public function sessionStart()
    {
        session_start();
    }

    public function sessionStop()
    {
        session_destroy();
    }


}
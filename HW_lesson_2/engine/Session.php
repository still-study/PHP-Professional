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

    public function setSession($key, $value)
    {
        return $_SESSION[$key] = $value;
    }

    public function getSession($key)
    {
        return $_SESSION[$key];
    }

    public function sessionRegenerate()
    {
        session_regenerate_id();
    }


}
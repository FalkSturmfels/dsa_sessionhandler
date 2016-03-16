<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 20.01.2016
 * Time: 12:49
 */
class SimpleSessionHandler
{
    /**
     * @var int session expire time in seconds
     */
    private $expireTime = 1800;

    public function startSession()
    {
        session_start();
        $this->checkLastActivity();
    }

    /**
     * Checks if the last user activity was more than $expireTime seconds ago.
     * If it is, the session will be destroyed, otherwise the session will be regenerated and
     * the last activity time will be set new.
     */
    private function checkLastActivity()
    {
        if (isset($_SESSION["LAST_ACTIVITY"]) && time() - $_SESSION["LAST_ACTIVITY"] > $this->expireTime)
        {
            session_unset();
            session_destroy();
        }
        else
        {
            session_regenerate_id(true);
            $_SESSION["LAST_ACTIVITY"] = time();
        }
    }
}
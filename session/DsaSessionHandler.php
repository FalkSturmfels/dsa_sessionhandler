<?php

/**
 * Created by IntelliJ IDEA.
 * User: achim.fritz
 * Date: 20.01.2016
 * Time: 12:49
 */
class DsaSessionHandler
{
    private $expireTime = 1800;

    public function startSession()
    {
        session_start();

        $this->regenerateSession();
        $this->checkLastActivity();
    }

    private function checkLastActivity()
    {
        if (isset($_SESSION["LAST_ACTIVITY"]) && time() - $_SESSION["LAST_ACTIVITY"] > $this->expireTime)
        {
            session_unset();
            session_destroy();
        }
        else
        {
            $_SESSION["LAST_ACTIVITY"] = time();
        }
    }

    private function regenerateSession()
    {
        if (!isset($_SESSION['CREATED']))
        {
            $_SESSION['CREATED'] = time();
        }
        else if (time() - $_SESSION['CREATED'] > 1800)
        {
            // session started more than 30 minutes ago
            session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
            $_SESSION['CREATED'] = time();  // update creation time
        }
    }
}
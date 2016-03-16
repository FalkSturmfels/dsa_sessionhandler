<?php
/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 16.03.2016
 * Time: 22:20
 */
$path = dirname(__FILE__).DIRECTORY_SEPARATOR."session".DIRECTORY_SEPARATOR."SimpleSessionHandler.php";
require_once($path);

$sessionHandler = new SimpleSessionHandler();
$sessionHandler->startSession();
<?php

/*
 * Shows the meatballs view.
 */
require_once 'resources/fragments/init.php';
use classes\controller\Controller;

$contr = Controller::getSavedController();
if(empty($contr))
{
    $contr = new Controller();
}

include 'resources/views/meatballs.php';

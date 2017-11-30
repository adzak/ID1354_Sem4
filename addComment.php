<?php

use classes\controller\Controller;
require_once 'resources/fragments/init.php';

if(isset($_POST['comment']))
{
    
    $contr = Controller::getSavedController();
    $contr->addComment($_POST['comment'],$_POST['commenttype']);
    
    if($_POST['commenttype'] === 'meatballs')
        include 'resources/views/meatballs.php';
    
    if($_POST['commenttype'] === 'pancakes')
        include 'resources/views/pancakes.php';
}



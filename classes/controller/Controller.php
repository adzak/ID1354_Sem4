<?php

namespace classes\controller;

use classes\model\HandleLogin;
use classes\model\RegisterUser;
use classes\model\CommentAdder;

class Controller
{
    private $nickname;
    
    public function login($uname,$password)
    {
        $handlelogin = new HandleLogin();
        $result = $handlelogin->verifyLogin($uname, $password);
        return $result;
    }
    
    public function registerUser($uname,$password)
    {
        $registeruser = new RegisterUser();
        $registeruser->RegisterUser($uname, $password);
    }
    
    public function addComment($comment,$commenttype)
    {
        $commentadder = new CommentAdder;
        $commentadder->addComment($comment, $commenttype, $this->nickname);
    }
    
    public function getComments($commenttype)
    {
        if($commenttype === 'meatballs')
        {
            $commentData = file('classes/integration/container.html');
            return $commentData;
        }
        
        if($commenttype === 'pancakes')
        {
            $commentData = file('classes/integration/containerpancakes.html');
            return $commentData;
        }
    }
    
    public function deleteComment($timestamp, $commenttype)
    {
        $commentadder = new CommentAdder;
        $commentadder->deleteComment($timestamp,$commenttype);   
    }
    
    public function getTimestamps($commenttype)
    {
        $commentadder = new CommentAdder;
        $return = $commentadder->getTimestamps($commenttype,$this->nickname);
        
        return $return;

    }
    
    public static function getSavedController()
    {
        return unserialize($_SESSION['controller']);
    }
    
    public static function saveController($Controller)
    {
        $_SESSION['controller'] = serialize($Controller);
    }
    
    public static function createController()
    {
        return new Controller();
    }
    
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
    }
    
    public function getNickname()
    {
        return $this->nickname;
    }
    
}


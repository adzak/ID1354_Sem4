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
        
        /*
        $content = $comment;
        $handle = fopen("classes/integration/container.html", "a");
        $t=time();
        fwrite($handle, "<b>".$this->nickname." ".gmdate("Y-m-d",$t)."</b>:<br>".$content."<p hidden>".time().",".$this->nickname."</p><br><br>"."\n");
        fclose($handle);
        */
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


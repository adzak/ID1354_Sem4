<?php

namespace classes\model;

use classes\integration\databaseHandler;

class CommentHandler
{
    private $databaseHandler;
    
    public function __construct()
    {
        $this->databaseHandler = new databaseHandler();
    }
    
    public function addComment($comment,$type,$nickname)
    {
        if($type === 'meatballs')
            $this->addcommentMB($comment,$nickname);
       
        if($type === 'pancakes')
            $this->addCommentPC($comment,$nickname);
    }
    
    public function deleteComment($timestamp,$commenttype)
    {
        if($commenttype === 'meatballs')
            $this->deletecommentMB($timestamp);
        
        if($commenttype === 'pancakes')
            $this->deletecommentPC($timestamp);
        
    }
    
    public function getTimestamps($commenttype,$nickname)
    {
        if($commenttype === 'meatballs')
        {
          $timestamps = $this->timestampMB($nickname);
          return $timestamps;
        }
        
        if($commenttype === 'pancakes')
        {
          $timestamps = $this->timestampPC($nickname);
          return $timestamps;
        }
           
    }
      
    private function deletecommentMB($timestamp)
    {
        //$commentData = file('classes/database/container.html'); 
        //file_put_contents('classes/database/container.html','');
        $commentData = $this->databaseHandler->getCommentsMB();
        $this->databaseHandler->clearMB();
        foreach($commentData as $line){
            if(strpos($line, $timestamp) === false)
            {
               $this->databaseHandler->deletecommentMB($line);
            }
        }
    }
    
    private function deletecommentPC($timestamp)
    {
        //$commentData = file('classes/database/containerpancakes.html');
        //file_put_contents('classes/database/containerpancakes.html','');
        $commentData = $this->databaseHandler->getCommentsPC();
        $this->databaseHandler->clearPC();
        foreach($commentData as $line){
            if(strpos($line, $timestamp) === false)
            {
               $this->databaseHandler->deletecommentPC($line);
            }
        }  
    }
    
    private function addcommentMB($comment,$nickname)
    {
        $content = htmlentities($comment, ENT_QUOTES);
        if(ctype_print($content))
        {
            /*
            $this->databaseHandler->deletecommentPC($line);
            $handle = fopen("classes/database/container.html", "a");
            $t=time();
            fwrite($handle, "<b>".$nickname." ".gmdate("Y-m-d",$t)."</b>:<br>".$content."<p hidden>".time().",".$nickname."</p><br><br>"."\n");
            fclose($handle);
            */
            
            $this->databaseHandler->addCommentMB($content, $nickname);
        }
    }
    
    private function addcommentPC($comment,$nickname)
    {
        $content = htmlentities($comment, ENT_QUOTES);
        if(ctype_print($content))
        {
            /*
            $handle = fopen("classes/database/containerpancakes.html", "a");
            $t=time();
            fwrite($handle, "<b>".$nickname." ".gmdate("Y-m-d",$t)."</b>:<br>".$content."<p hidden>".time().",".$nickname."</p><br><br>"."\n");
            fclose($handle);
            */
            
            $this->databaseHandler->addCommentPC($content, $nickname);
             
        }
    }
    
    private function timestampMB($nickname)
    {
        $commentData = $this->getCommentsMB();
        $i = 0;
        $accessData = array();
        foreach ($commentData as $line) 
        {
            if(strpos($line, $nickname) !== false) 
            {
                list($comment, $user) = explode('hidden>', $line);
                $accessData[$i++] = trim($user);
            }
        }
        
        return $accessData;
    }
    
    private function timestampPC($nickname)
    {
        $commentData = $this->getCommentsPC();
        $i = 0;
        $accessData = array();
        foreach ($commentData as $line) 
        {
            if(strpos($line, $nickname) !== false) 
            {
                list($comment, $user) = explode('hidden>', $line);
                $accessData[$i++] = trim($user);
            }
        }
        
        return $accessData;
    }
    
    public function getCommentsMB()
    {
        $return = $this->databaseHandler->getCommentsMB();
        return $return;
    }
    
    public function getCommentsPC()
    {
        $return = $this->databaseHandler->getCommentsPC();
        return $return;
    }
      
}

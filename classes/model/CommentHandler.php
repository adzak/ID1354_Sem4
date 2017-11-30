<?php

namespace classes\model;

class CommentHandler
{
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
        $commentData = file('classes/integration/container.html');
        file_put_contents('classes/integration/container.html','');
        foreach($commentData as $line){
            if(strpos($line, $timestamp) === false)
            {
                $handle = fopen("classes/integration/container.html", "a");
                fwrite($handle,$line);
                fclose($handle);    
            }
        }
    }
    
    private function deletecommentPC($timestamp)
    {
        $commentData = file('classes/integration/containerpancakes.html');
        file_put_contents('classes/integration/containerpancakes.html','');
        foreach($commentData as $line){
            if(strpos($line, $timestamp) === false)
            {
                $handle = fopen("classes/integration/containerpancakes.html", "a");
                fwrite($handle,$line);
                fclose($handle);    
            }
        }  
    }
    
    private function addcommentMB($comment,$nickname)
    {
        $content = htmlentities($comment, ENT_QUOTES);
        if(ctype_print($content))
        {
            $handle = fopen("classes/integration/container.html", "a");
            $t=time();
            fwrite($handle, "<b>".$nickname." ".gmdate("Y-m-d",$t)."</b>:<br>".$content."<p hidden>".time().",".$nickname."</p><br><br>"."\n");
            fclose($handle);
        }
    }
    
    private function addcommentPC($comment,$nickname)
    {
        $content = htmlentities($comment, ENT_QUOTES);
        if(ctype_print($content))
        {
            $handle = fopen("classes/integration/containerpancakes.html", "a");
            $t=time();
            fwrite($handle, "<b>".$nickname." ".gmdate("Y-m-d",$t)."</b>:<br>".$content."<p hidden>".time().",".$nickname."</p><br><br>"."\n");
            fclose($handle);
        }
    }
    
    private function timestampMB($nickname)
    {
        $commentData = file('classes/integration/container.html');
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
        $commentData = file('classes/integration/containerpancakes.html');
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
      
}

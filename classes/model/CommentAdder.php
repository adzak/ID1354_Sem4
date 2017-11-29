<?php

namespace classes\model;

class CommentAdder
{
    public function addComment($comment,$type,$nickname)
    {
        if($type === 'meatballs')
            $this->addcommentMB($comment,$nickname);
       
        if($type === 'pancakes')
            $this->addCommentPC($comment,$nickname);
    }
    
    private function addcommentMB($comment,$nickname)
    {
        $content = $comment;
        $handle = fopen("classes/integration/container.html", "a");
        $t=time();
        fwrite($handle, "<b>".$nickname." ".gmdate("Y-m-d",$t)."</b>:<br>".$content."<p hidden>".time().",".$nickname."</p><br><br>"."\n");
        fclose($handle);
    }
    
    private function addcommentPC($comment,$nickname)
    {
        $content = $comment;
        $handle = fopen("classes/integration/containerpancakes.html", "a");
        $t=time();
        fwrite($handle, "<b>".$nickname." ".gmdate("Y-m-d",$t)."</b>:<br>".$content."<p hidden>".time().",".$nickname."</p><br><br>"."\n");
        fclose($handle);
    }
     
}

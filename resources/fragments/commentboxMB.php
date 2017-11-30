<?php

require_once 'resources/fragments/init.php';
use classes\controller\Controller;
$contr = Controller::getSavedController();
if(!empty($contr)) 
{
    $name = $contr->getNickname();
    if(trim($name) !== '')
    {
        echo'
            <h2>Add a public comment</h2>
            <div class="comments">
            <form action="addComment.php" method = "POST">
                <label>Comment</label>
                <input type="text" id="comment" name="comment" placeholder="Type your comment here..">
                <input type="submit" value="Post comment">
                <input type="hidden" value="meatballs" name="commenttype">
            </form>
        </div>';
    }
    
    else 
    {
        echo '<h2>Log in to add a public comment</h2><br>';
    }
}

else 
{
    echo '<h2>Log in to add a public comment</h2><br>';
}





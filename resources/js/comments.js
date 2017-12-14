$(document).ready(function () {

    $("button#postComment").click(function () {
        alert("Your comment has been posted!");
        $.post("addComment.php", $("#postC").serialize());
    });
  
    $("button#loadcommentsMB").click(commentHandler);
  
    function commentHandler() 
    {
        alert("Comments updated!");
        $(".commentbox").html("");
        $.get("classes/database/container.html", function(my_var) {
        var n = my_var.split("\n");
        var tp = new Array();
        
        for (var k = 0; k < n.length; k++)
        {
            tp[k] = n[k].substring(n[k].lastIndexOf("n>") + 2,n[k].lastIndexOf("</p"));
        }

        for (var i = 0; i < n.length; i++) 
        {
            var result = n[i].match($("#nicknameLabel").text());
            if(result == $("#nicknameLabel").text() && ($("#nicknameLabel").text() != "")) 
            {
                var deleteComment = $("<form id = \"delMB\" method = \"POST\" onsubmit = \"return false\">");
                $(n[i]).appendTo(deleteComment);
                $("<input type=\"hidden\" name=\"delete\">").appendTo(deleteComment);
                $("<input type=\"hidden\" value = \"meatballs\" name = \"commenttype\">").appendTo(deleteComment);
                $("<input type='hidden' name='timestamp' value='" + tp[i] + "'/></form>").appendTo(deleteComment);
                $("<button>Delete</button>").click(deleteButtonHandler).appendTo(deleteComment);
                $(deleteComment).appendTo(".commentbox"); 
            }
            
            else 
            {
                $(n[i]).appendTo(".commentbox");
            }
        }

    });}  
    
    $("button#loadcommentsPC").click(commentHandlerP);
    
    function commentHandlerP() 
    {
        alert("Comments updated!");
        $(".commentbox").html("");
        $.get("classes/database/containerpancakes.html", function(my_var) {
        var n = my_var.split("\n");
        var tp = new Array();
        
        for (var k = 0; k < n.length; k++)
        {
            tp[k] = n[k].substring(n[k].lastIndexOf("n>") + 2,n[k].lastIndexOf("</p"));
        }

        for (var i = 0; i < n.length; i++) 
        {
            var result = n[i].match($("#nicknameLabelP").text());
            if(result == $("#nicknameLabelP").text() && ($("#nicknameLabelP").text() != "")) 
            {
                var deleteComment = $("<form id = \"delPC\" method = \"POST\" onsubmit = \"return false\">");
                $(n[i]).appendTo(deleteComment);
                $("<input type=\"hidden\" name=\"delete\">").appendTo(deleteComment);
                $("<input type=\"hidden\" value = \"pancakes\" name = \"commenttype\">").appendTo(deleteComment);
                $("<input type='hidden' name='timestamp' value='" +
                                tp[i] + "'/></form>").appendTo(deleteComment);
                $("<button>Delete</button>").click(deleteButtonHandler).appendTo(deleteComment);
                $(deleteComment).appendTo(".commentbox"); 
            }
            
            else 
            {
                $(n[i]).appendTo(".commentbox");
            }
        }

    });}  
    
    function deleteButtonHandler()
    {
        $.post("deleteComment.php", $(this).siblings("input").serialize());
        alert($(this).siblings("input").serialize());

    }
});
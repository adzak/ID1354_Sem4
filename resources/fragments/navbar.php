<ul>
    <li><a href="index.php">HOME</a></li>
    <li><a href="recipes.php">RECIPES</a></li>
    <li><a href="calendar.php">CALENDAR</a></li>
    <li>   
        <?php
            require_once 'resources/fragments/init.php';
            use classes\controller\Controller;
            $contr = Controller::getSavedController();
            if(!empty($contr))
            {
                $name = $contr->getNickname();
                echo '
                    <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">LOGGED IN AS: '.$name.'</a>
                    <div class="dropdown-content">
                    <a href="login.php">LOG OUT</a>
                    </div>
                    </li>
                    ';
            }
            else
                echo '<a href="login.php">LOGIN</a>';
        ?>
    </li>
</ul>


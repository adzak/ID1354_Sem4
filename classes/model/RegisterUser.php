<?php

namespace classes\model;

class RegisterUser
{
    public function RegisterUser($uname,$psw)
    {
        if(ctype_print($uname) && ctype_print($uname))
        {
            $handle = fopen("classes/integration/accounts.txt", "a");
            $password = password_hash($psw, PASSWORD_DEFAULT);
            fwrite($handle,"\n".$uname.','.$password);
            fclose($handle);
        }
    }
}


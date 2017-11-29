<?php

namespace classes\model;

class RegisterUser
{
    public function RegisterUser($uname,$psw)
    {
        $handle = fopen("classes/integration/accounts.txt", "a");
        fwrite($handle,"\n".$uname.','.$psw);
        fclose($handle);
    }
}


<?php

namespace classes\model;

class HandleLogin
{
    public function verifyLogin($uname,$psw)
    {
        if(ctype_print($uname) && ctype_print($uname))
        {
            $loginData = file('classes/integration/accounts.txt');
            $accessData = array();
            foreach ($loginData as $line) {
            list($username, $password) = explode(',', $line);
            $accessData[trim($username)] = trim($password);
            }

            if (array_key_exists($uname, $accessData) && password_verify($psw,$accessData[$uname]))
            {
                return true;
            } 

            else 
            {
                return false;
            }
    }   }
}


<?php

namespace classes\model;

class HandleLogin
{
    public function verifyLogin($uname,$psw)
    {
        // Parse users.txt
        $loginData = file('classes/integration/accounts.txt');
        $accessData = array();
        foreach ($loginData as $line) {
        list($username, $password) = explode(',', $line);
        $accessData[trim($username)] = trim($password);
        }

        // Check input versus login.txt data
        if (array_key_exists($uname, $accessData) && $psw == $accessData[$uname]) 
        {
            return true;
        } 
    
        else 
        {
            return false;
        }
    }
}

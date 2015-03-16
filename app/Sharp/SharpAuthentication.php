<?php namespace App\Sharp;

use Dvlpp\Sharp\Auth\SharpAuth;
use App\Sharp\User\User;
use Auth;

class SharpAuthentication implements SharpAuth {

    /**
     * Return true if a CMS admin is logged in.
     *
     * @return mixed
     */
    function checkAdmin()
    {
        return Auth::user();
    }

    /**
     * Logs the user in.
     * Must return the user login.
     *
     * @param $login
     * @param $password
     * @return mixed
     */
    function login($login, $password)
    {
        if (Auth::attempt(array('login' => $login, 'password' => $password)))
        {
            return Auth::user()->login;
        }
        return false;
    }

    /**
     * Logout the user.
     *
     * @return mixed
     */
    function logout()
    {
        Auth::logout();
    }

    /**
     * Check if the user has the permission for the action described
     * by $type (entity), $action (view, update, ...) and $key (entity name).
     *
     * @param $login
     * @param $type
     * @param $action
     * @param $key
     * @return mixed
     */
    function checkAccess($login, $type, $action, $key)
    {
        if($login == Auth::user()->login)
        {
            $user = Auth::user();
        }
        else
        {
            $user = User::where("login", $login)->first();
        }

        if($user)
        {
            if($key == "zone")
            {
                return $user->login == "admin";
            }

            elseif($key == "giraffe")
            {
                switch($action)
                {
                    case "delete":
                    case "create":
                        return $user->login == "admin";
                }
            }

            return true;
        }

        return false;
    }
}
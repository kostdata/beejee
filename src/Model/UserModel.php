<?php
defined('_APP_EXEC') or die('Доступ запрещен');
class UserModel
{
      
    public function login($username, $password)
    {
        if($username == 'admin' AND $password == '123'){
            $_SESSION['username'] = $username;
            return true;
        }
         else return false;
            
        
    }      
    public function logout()
    {
        unset($_SESSION['username']);
        return true;
    }
          
    public function isLoggedIn()
    {
        if (isset($_SESSION['username']) && $_SESSION['username'] !='') return true;
        return false;
    }
    public function isAdmin(){
        
        if (isset($_SESSION['username']) AND $_SESSION['username'] == 'admin') return true;
        else return false;
    } 
                                                     

}
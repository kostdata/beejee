<?php

class AuthController implements ControllerInterface
{

  

    
    private $UserModel;
    private $TaskModel;


    public function __construct($TaskModel)
    {
             $this->TaskModel = $TaskModel;   
             $this->UserModel = new UserModel;   
    }


    public function indexAction($request)
    {
        $this->loginAction();
    }


    public function loginAction()
    {
        if ($this->UserModel->isLoggedIn()) {
            $this->redirectAction();
        }

        $View = new TaskView($this->TaskModel);
        $View->loginForm();
    }

    public function redirectAction($route = "index.php")
    {
        header("location: $route");
        exit;
    }

    public function loginsubmittedAction()
    {
        $password = $_POST['password'];
        $username = $_POST['username'];
        if($password == '' OR $username == '')
        { 
            $_SESSION['message'] = 'поля обязательны для заполнения';
            $this->redirectAction("?action=login");
            return;
        }
        if($this->UserModel->login($username,$password))
          $this->redirectAction();  
         else {
             $_SESSION['message'] = 'Ошибка авторизации проверьте логин/пароль';
            $this->redirectAction("?action=login");
        }
    }

    public function logoutAction()
    {
        $this->UserModel->logout();
        $this->redirectAction();
    }

}
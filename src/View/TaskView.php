<?php
defined('_APP_EXEC') or die('Доступ запрещен');
class TaskView
{

    private $content; 


    public function __construct(TaskModel $TaskModel)
    {
        $this->TaskModel = $TaskModel;
    }


    public function __destruct()
    {
        include 'src/View/Layout/layout.php';
    }


    public function taskList($tasks = null,$pagenav)
    {
        ob_start();
        require "src/View/task/list.php";
        $this->content = ob_get_clean();
    }
    public function task($variables = null)
    {
        ob_start();
        require "src/View/task/task.php";
        $this->content = ob_get_clean();
    }
    public function addTask($variables = null)
    {
        ob_start();
        require "src/View/task/add.php";
        $this->content = ob_get_clean();
    }
    public function loginForm($variables = null)
    {
        ob_start();
        require "src/View/auth/login.php";
        $this->content = ob_get_clean();
    }


    public function indexView()
    {                                    
        
    }


}
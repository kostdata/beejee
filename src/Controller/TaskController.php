<?php
defined('_APP_EXEC') or die('Доступ запрещен');
class TaskController implements ControllerInterface
{    
    var $pagelimit = 3;
    public function __construct($TaskModel)
    {
     $this->TaskModel = $TaskModel;   
    }


    public function indexAction($request)
    {
        return $this->listAction();
    }

    public function listAction()
    {    
        $order = $_GET['orderby'];
        $page = intval($_GET['page']);
        switch($order){
            case 'name_up' : $orderby = 'username desc';
            break;
            case 'name_down' :   $orderby = 'username asc';
            break;
            case 'email_up' :   $orderby = 'email desc';
            break;
            case 'email_down' :   $orderby = 'email asc';
            break;
            case 'status_up' :    $orderby = 'taskstatus desc' ;
            break;
            case 'status_down' :  $orderby = 'taskstatus asc';
            break;
            default: $orderby = 'id desc';
        }
        $link = "./?orderby=$order";
        $total = $this->TaskModel->getCount();
        $pagenav = new Pagination($total,$page*$this->pagelimit,$this->pagelimit,$link);
        $tasks = $this->TaskModel->getAll($page*$this->pagelimit,$this->pagelimit,$orderby);        
        $View = new TaskView($this->TaskModel);
        $View->taskList($tasks,$pagenav);
    }
        
    public function addAction()
    {
        $id = intval($_GET['id']);
        if(UserModel::isAdmin() AND $id) $this->TaskModel->get($id);        
        $View = new TaskView($this->TaskModel);
        $View->addTask();
    }
    public function saveAction()
    {
        
        $id = intval($_POST['id']);
        if($id){
        if(!UserModel::isAdmin()){
           $_SESSION['message'] = 'Ошибка сохранения, зайдите под админом]' ;
           $this->redirectAction();
           return;
        }
          $this->TaskModel->get($id);
          if($this->TaskModel->id){
             $this->TaskModel->tasktext = $_POST['tasktext'] ;
             $this->TaskModel->isedit = 1 ;
             if($this->TaskModel->update()) $_SESSION['message'] = 'Успешно сохранено' ;
             else $_SESSION['message'] = 'Ошибка сохранения';
          }
          else  $_SESSION['message'] = 'Задача не найдена';

          
          $this->redirectAction();
        }
        elseif(!$id){ 
            
            if(mb_strlen($_POST['username']) < 1) $_SESSION['message'][] = 'Укажите имя';
                else $data['username'] = $_POST['username'] ;;
            if(mb_strlen($_POST['tasktext']) < 1) $_SESSION['message'][] ='Укажите задачу';
                else $data['tasktext'] = $_POST['tasktext'];
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) === false  OR !preg_match('/@.+\./', $_POST['email'])) $_SESSION['message'][] ='Укажите верный email';
                else $data['email'] = $_POST['email'];
            $this->TaskModel->bind($data);
            if(count($_SESSION['message']) == 0){
            $this->TaskModel->tasktext = $this->TaskModel->tasktext;
            if($this->TaskModel->add()){
                $_SESSION['message'] = 'Задача сохранена';
            }
            else {
                $_SESSION['message'] = 'Ошибка сохранения';
            }            
            $this->redirectAction();
            }
            else{
           $errors = $this->TaskModel->getError();
           foreach($errors as $error) $_SESSION['message'][] = $error;
            $View = new TaskView($this->TaskModel);
            $View->addTask();    
            }
        }
    }
    public function checkAction()
    {      
        
        $id = intval($_GET['id']);
        if(!UserModel::isAdmin()){           
           $_SESSION['message'] = "У вас нет прав, зайдите под админом";
           $this->redirectAction();
           return;
        }
        $this->TaskModel->get($id);
        
        if($this->TaskModel->id){
            $this->TaskModel->taskstatus = 1;
            $this->TaskModel->update();
            $_SESSION['message'] = "Статус обновлен";
            $this->redirectAction();    
        }
        else{         
           $_SESSION['message'] = "Ошибка не найдена задача";
           $this->redirectAction();
           return;
        }
    }
    public function updateAction()
    {
        $id = intval($_POST['id']);
        $tasktext = intval($_POS['tasktext']);
        if(UserModel::isAdmin()){           
           $_SESSION['message'] = "У вас нет прав, зайдите под админом";
           $this->redirectAction();
           return;
        }
        $this->TaskModel->get($id);
        if($this->TaskModel->id){
            $this->TaskModel->isedit = 1;
            $this->TaskModel->tasktext = 1;
            $this->TaskModel->update();    
        }
        else{         
           $_SESSION['message'] = "Ошибка не найдена задача";
           $this->redirectAction();
           return;
        }
    }

    public function redirectAction($route="index.php")
    {
        header("location: $route");
        exit;
    }


}
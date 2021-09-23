<?php
defined('_APP_EXEC') or die('Доступ запрещен');
class TaskModel
{
    private $db;
    var $id = null;
    var $username = null;
    var $email = null;
    var $tasktext = null;
    var $taskstatus = null;
    var $isedit = null;
    var $_error = array();
    public function __construct($dbConnection)
    {
        if ($dbConnection instanceof mysqli) {
            $this->db = $dbConnection;
        } else {
            throw new Exception('Connection injected should be of Mysqli object');
        }
    }

    
    public function getAll($limitstart = 0, $limit = 3,$orderby = ' id desc')
    {
        $query = "SELECT * FROM `beejee_task` ORDER BY $orderby LIMIT $limitstart,$limit";
        $result = $this->db->query($query);
        if ($result) {            
            while ($row = $result->fetch_object()) {
                $task[] = $row;
            }            
        } else {
            echo($this->db->error);
        }
        return $task;
    }
    public function getCount()
    {
        $query = "SELECT count(*) FROM `beejee_task` ";
        
        $result = $this->db->query($query);
        if ($result) {            
            while ($row = $result->fetch_row()) {
                $total = $row[0];
            }            
        } else {
            echo($this->db->error);
        }
        return $total;
    }
    public function bind($data){            
            $this->username = $data['username'];
            $this->tasktext = $data['tasktext'];
            $this->email = $data['email'];
    }
    public function get($id)
    {
        
        $query = "SELECT * FROM `beejee_task` WHERE id = $id ";
        
        if ($result = $this->db->query($query)) {
            $row = $result->fetch_object();          
            $this->id = $row->id;            
            $this->username = $row->username;
            $this->tasktext = $row->tasktext;
            $this->email = $row->email;
            $this->taskstatus = $row->taskstatus;
            $this->isedit = $row->isedit;
        } else {
            die($this->db->error);
        }        
    }
                         
    public function addError($error){
        $this->_error[] = $error;
    }
    public function getError(){
        return $this->_error;
    }
    public function add()
    {
        $query = "INSERT INTO `beejee_task`( `username`, `email`,`tasktext`, `taskstatus`, `isedit`) VALUES ('".$this->db->real_escape_string($this->username)."','".$this->email."','".$this->db->real_escape_string($this->tasktext)."','".$this->taskstatus."','".$this->isedit."')";       
        if ($result = $this->db->query($query)) {
            return true;
        } else {
            return false;
        }
    }
    public function update()
    {   
        $query = "UPDATE `beejee_task` SET `username`='".$this->db->real_escape_string($this->username)."',`email`='".$this->email."',`tasktext`='".$this->db->real_escape_string($this->tasktext)."',`taskstatus`='".$this->taskstatus."',`isedit`='".$this->isedit."' WHERE id = $this->id";        
        if ($result = $this->db->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    


}
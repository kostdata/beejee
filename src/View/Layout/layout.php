<?php defined('_APP_EXEC') or die('Доступ запрещен'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Список задач</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="public/css/style.css" >          

</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href='.'>Главная</a>
      <?php if(UserModel::isLoggedIn()) {?>
            <a class="nav-item nav-link" href='?action=logout'>Выйти</a>
      <?php } 
            else{
              ?>
              <a class="nav-item nav-link" href='?action=login'>Войти</a>
              <?php
      }?>
      <a class="nav-item nav-link" href='?action=add'>Добавить задачу</a>

    </div>
  </div>
</nav>    
  
   
    <div class="row">
        <div class="col-md-12">
        <?php
    if(isset($_SESSION['message'])){
        if(is_array($_SESSION['message'])){
            foreach($_SESSION['message'] as $message)
            echo "<div>".$message."<div>";
        }
        else  echo "<div>".$_SESSION['message']."<div>";
        unset($_SESSION['message']);
    }
     ?>
            <?= $this->content; ?>
        </div>
    </div>
    <hr>
    <footer>
    </footer>
</div>
</body>
</html>
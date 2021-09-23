<h1>Список задач</h1>
<div class="container grid-striped">

    

        <?php
        
      if(count($tasks)){
          $sortlink = './?page='.$_GET['page'];
          ?>
        <div class="row ">   
        <div class="col-sm-2">Имя пользователя <a class="sort" href="<?php echo $sortlink.'&orderby=name_down' ?>" data-sort='name_down'><i class="fa fa-fw fa-sort-down"></i></a><a class="sort" href="<?php echo $sortlink.'&orderby=name_up' ?>" data-sort='name_up'><i class="fa fa-fw fa-sort-up"></i></a></div>
        <div class="col-sm-2">Email<a class="sort" href="<?php echo $sortlink.'&orderby=email_down' ?>" data-sort='email_down'><i class="fa fa-fw fa-sort-down"></i></a><a class="sort" href="<?php echo $sortlink.'&orderby=email_up' ?>" data-sort='email_up'><i class="fa fa-fw fa-sort-up"></i></a></div>
        <div class="col -sm-4">Задача</div>
        <div class="col-sm-2"> Статус <a class="sort" href="<?php echo $sortlink.'&orderby=status_down' ?>" data-sort='status_down'><i class="fa fa-fw fa-sort-down"></i></a><a class="sort" href="<?php echo $sortlink.'&orderby=status_up' ?>" data-sort='status_up'><i class="fa fa-fw fa-sort-up"></i></a></div>
        <?php echo UserModel::isAdmin()?'<div class="col-sm-2">Действие</div>':''; 
       ?> </div> <?php
        foreach ($tasks as $task)
        {
          $editlink = !UserModel::isAdmin()?'<a href="?action=edit&id='.$task->id.'" class="glyphicon">&#x270f;</a>':'';
          ?>
          <div class="row ">
          <div class="w-100 bg-light"></div>
          <div class="col-sm-2"><?php echo $task->username ?></div>
          <div class="col-sm-2"><?php echo $task->email ?></div>
          <div class="col-sm-4"><?php echo htmlspecialchars($task->tasktext)?>        </div>
          <div class="col-sm-2">
          <?php echo $task->taskstatus==1?'Выполнена':''?>
          <?php echo $task->isedit==1?'Отредактировано администратором':''?>
          </div>
          <?php if(UserModel::isAdmin()){
            ?>
            <div class="col-sm-1">
            <a class="btn btn-default" href="<?php echo '?action=edit&id='.$task->id ?>" role="button">Изменить</a>
            <?php if($task->taskstatus == 0){ ?>
            <a class="btn btn-default" href="<?php echo '?action=admincheck&id='.$task->id?>" role="button">Выполнено</a>
            <?php } ?>
            </div>
            <?php
          }
                 ?> </div> <?php

        }
      }
      else{
        echo "Нет задач";
      }
      ?>
    </div>
    <div class="row">
    <?php echo $pagenav->showPageNavigation() ?>
    </div>
</div>
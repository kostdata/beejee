<?php defined('_APP_EXEC') or die('Доступ запрещен'); ?>
<h1> <?php echo $this->TaskModel->id?'Изменить задачу':'Добавить задачу' ?></h1>
<div class="row">

    <div class="col-md-8">
        
        <form action="?action=savetask" class="form-horizontal"  method="post">
            <div class="form-group">
                <label class="control-label col-sm-4" for="title">Имя пользователя:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" <?php echo $this->TaskModel->id?'disabled':'' ?> value = "<?php echo $this->TaskModel->username ?>" id="username" name="username" placeholder="имя пользователя">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="title">email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" <?php echo $this->TaskModel->id?'disabled':'' ?> value = "<?php echo $this->TaskModel->email ?>"  id="email" name="email" placeholder="email">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="content">текст задачи:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="tasktext" name="tasktext" cols="120"><?php echo $this->TaskModel->tasktext ?></textarea>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Отправить</button>
                    <a class="btn btn-default" href="/" role="button">Отмена</a>

                </div>
                
            </div>
            <input type="hidden" name="id" value="<?php echo $this->TaskModel->id ?>">
        </form>



    </div>
</div>
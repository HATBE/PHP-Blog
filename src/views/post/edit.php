<?php Template::load('header');?>
    <?php Template::load('backBtn', array('path' => $data['backPath']));?>
    <?php Template::load('postForm', array('title' => $data['title'], 'body' => $data['body'], 'actionName' => $data['actionName'], 'errors' => $data['errors']));?>
<?php Template::load('footer');?>
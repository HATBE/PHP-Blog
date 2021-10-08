<?php Template::load('header');?>
    <?php Template::load('backBtn', array('path' => $data['backPath']));?>
    <?php Template::load('deleteQuestion', array('actionName' => 'Post', 'id' => $data['id']));?>
<?php Template::load('footer');?>
<?php Template::load('header');?>
  <?php Template::load('backBtn', array('path' => $data['backPath']));?>
  <?php Template::load('userForm', array('actionName' => $data['actionName'], 'username' => $data['username'], 'errors' => $data['errors']));?>
<?php Template::load('footer');?>
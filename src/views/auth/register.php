<?= Template::load('header', ['title' => 'Register']);?>

<?= Template::load('userForm', ['username' => $data['username'], 'msg' => $data['msg'], 'action' => 'Register']);?>

<?= Template::load('footer');?>
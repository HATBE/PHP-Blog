<?= Template::load('header', ['title' => 'Login']);?>

<?= Template::load('userForm', ['username' => $data['username'], 'msg' => $data['msg'], 'action' => 'Login']);?>

<?= Template::load('footer');?>
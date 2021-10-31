<?= Template::load('header', ['title' => 'Login']);?>

<?= Template::load('loginForm', ['username' => $data['username'], 'msg' => $data['msg']]);?>

<?= Template::load('footer');?>
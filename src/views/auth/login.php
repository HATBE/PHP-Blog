<?= Template::load('header', ['title' => 'Login', 'tags' => '']);?>

<h1 class="d-none">Login</h1>

<?= Template::load('userForm', ['username' => $data['username'], 'msg' => $data['msg'], 'action' => 'Login']);?>

<?= Template::load('footer');?>
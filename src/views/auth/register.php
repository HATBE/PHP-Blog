<?= Template::load('header', ['title' => 'Register', 'tags' => '']);?>

<h1 class="d-none">Register</h1>

<?= Template::load('userForm', ['username' => $data['username'], 'msg' => $data['msg'], 'action' => 'Register']);?>

<?= Template::load('footer');?>
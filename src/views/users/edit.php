<?= Template::load('header', ['title' => 'Edit User', 'tags' => '']);?>

<h1 class="d-none">Edit User</h1>

<?= Template::load('userForm', ['username' => $data['username'], 'msg' => $data['msg'], 'action' => 'Edit']);?>

<?= Template::load('footer');?>
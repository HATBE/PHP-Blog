<?= Template::load('header', ['title' => 'Edit']);?>

<?= Template::load('userForm', ['username' => $data['username'], 'msg' => $data['msg'], 'action' => 'Edit']);?>

<?= Template::load('footer');?>
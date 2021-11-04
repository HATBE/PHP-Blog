<?= Template::load('header', ['title' => 'Delete User', 'tags' => '']);?>

    <h1 class="d-none">Delete User</h1>

    <?= Template::load('backBtn', ['controller' => 'users', 'method' => 'index', 'args' => ''])?>
    <?= Template::load('delete', ['actionName' => 'User', 'id' => $data['id']]);?>

<?= Template::load('footer');?>
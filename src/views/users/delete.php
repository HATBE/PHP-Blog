<?= Template::load('header', ['title' => 'Home']);?>

    <?= Template::load('backBtn', ['controller' => 'users', 'method' => 'index', 'args' => ''])?>
    <?= Template::load('delete', ['actionName' => 'User', 'id' => $data['id']]);?>

<?= Template::load('footer');?>
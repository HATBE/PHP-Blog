<?= Template::load('header', ['title' => 'Home']);?>

    <?= Template::load('backBtn', ['controller' => 'posts', 'method' => 'index', 'args' => ''])?>
    <?= Template::load('delete', ['actionName' => 'Post', 'id' => $data['id']]);?>

<?= Template::load('footer');?>
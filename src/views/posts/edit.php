<?= Template::load('header', ['title' => 'Home']);?>

    <?= Template::load('backBtn', ['controller' => 'posts', 'method' => 'index', 'args' => ''])?>
    <?= Template::load('postForm', array('title' => $data['title'], 'body' => $data['body'], 'actionName' => $data['actionName'], 'errors' => $data['errors']));?>

<?= Template::load('footer');?>
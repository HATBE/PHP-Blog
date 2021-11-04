<?= Template::load('header', ['title' => 'Edit Post', 'tags' => '']);?>

    <h1 class="d-none">Edit Post</h1>

    <?= Template::load('backBtn', ['controller' => 'posts', 'method' => 'index', 'args' => ''])?>
    <?= Template::load('postForm', array('title' => $data['title'], 'body' => $data['body'], 'actionName' => $data['actionName'], 'errors' => $data['errors']));?>

<?= Template::load('footer');?>
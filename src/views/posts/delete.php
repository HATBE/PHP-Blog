<?= Template::load('header', ['title' => 'Delete Post', 'tags' => '']);?>

    <h1 class="d-none">Delete Post</h1>

    <?= Template::load('backBtn', ['controller' => 'posts', 'method' => 'index', 'args' => ''])?>
    <?= Template::load('delete', ['actionName' => 'Post', 'id' => $data['id']]);?>

<?= Template::load('footer');?>
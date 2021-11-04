<?= Template::load('header', ['title' => 'Home', 'tags' => '']);?>

    <h1 class="d-none">Home</h1>

    <?= Template::load('postsList', ['posts' => $data['posts']['posts'], 'meta' => $data['posts']['meta']]);?>
    <?= Template::load('pagination', ['meta' => $data['posts']['meta'], 'controller' => 'posts', 'method' => 'index']);?>

<?= Template::load('footer');?>
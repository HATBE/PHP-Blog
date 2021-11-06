<?= Template::load('header', ['title' => 'Home', 'tags' => '']);?>

    <h1 class="d-none">Home</h1>

    <?php if(isset($_SESSION['loggedIn'])):?>
        <div class="my-2">
            <a href="<?= Linker::link('posts', 'create')?>" class="btn btn-primary">+ ADD</a>
        </div>
    <?php endif;?>

    <?= Template::load('postsList', ['posts' => $data['posts']['posts'], 'meta' => $data['posts']['meta']]);?>
    <?= Template::load('pagination', ['meta' => $data['posts']['meta'], 'controller' => 'posts', 'method' => 'index', 'args' => isset($_GET['q']) ? '?q=' . $_GET['q'] : '']);?>

<?= Template::load('footer');?>
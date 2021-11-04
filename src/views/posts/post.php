<?= Template::load('header', ['title' => $data['post'] != null ? $data['post']->title : 'post not found', 'tags' => '']);?>

    <h1 class="d-none"><?=$data['post'] != null ? $data['post']->title : 'post not found'?></h1>

    <?= Template::load('backBtn', ['controller' => 'posts', 'method' => 'index', 'args' => $data['page']])?>
    <?php if($data['post'] !== null):?>
        <?php Template::load('post', ['post' => $data['post'], 'view' => false]);?>
    <?php else:?>
        <?php Template::load('alert', ['type' => 'danger', 'msg' => ['Post not found']]);?>
    <?php endif;?>

<?= Template::load('footer');?>
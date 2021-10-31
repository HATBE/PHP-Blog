<div class="card shadow text-white bg-dark my-3">
    <div class="card-body">
        <h5 class="card-title"><?= $post->title;?></h5>
        <p class="card-text"><?= $post->body;?></p>
        <?php if($view):?>
            <a href="<?= Linker::link('posts', 'post', [$post->pid, $page])?>" class="btn btn-secondary">Read more</a>
        <?php endif;?>
        <?php if(isset($_SESSION['loggedIn'])):?>
            <a href="<?= Linker::link('posts', 'edit', [$post->pid])?>" class="btn btn-primary">Edit</a>
            <a href="<?= Linker::link('posts', 'delete', [$post->pid])?>" class="btn btn-danger">Delete</a>
        <?php endif;?>
    </div>
    <div class="card-footer">
        <?= $post->date;?> By <b><?= $post->username;?></b>
    </div>
</div>
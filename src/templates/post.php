<div class="card text-white bg-dark my-3">
    <div class="card-body">
        <h5 class="card-title"><?= $post->title;?></h5>
        <p class="card-text"><?= $post->body;?></p>
            <a href="<?= ROOT_PATH . 'posts/post/' . $post->pid;?>" class="btn btn-primary">View</a>
            <a href="<?= ROOT_PATH . 'posts/edit/' . $post->pid;?>" class="btn btn-warning">Edit</a>
            <a href="<?= ROOT_PATH . 'posts/delete/' . $post->pid;?>" class="btn btn-danger">Delete</a>
    </div>
    <div class="card-footer">
        <?= $post->date;?> By <b><?= $post->username;?></b>
    </div>
</div>
 <div class="card text-white bg-secondary my-2">
    <?php if($post['id'] == $data['newestPostId']):?>
        <div class="bg-dark card-header">
            Newest
        </div>
    <?php endif;?>
    <div class="card-body">
        <h5 class="card-title"><?= $post['title'];?></h5>
        <p class="card-text"><?= $post['body'];?></p>
        <?php if($data['view']):?>
            <a href="<?= ROOT_PATH . 'posts/post/' . $post['id'] . '/' . $data['currentPage'];?>" class="btn btn-primary">View</a>
        <?php endif;?>
        <?php if(isset($_SESSION['loggedIn'])):?>
            <a href="<?= ROOT_PATH . 'posts/edit/' . $post['id'];?>" class="btn btn-warning">Edit</a>
            <a href="<?= ROOT_PATH . 'posts/delete/' . $post['id'];?>" class="btn btn-danger">Delete</a>
        <?php endif;?>
    </div>
    <div class="card-footer">
        <?= date('m/d/Y H:i', strtotime($post['date']));?> By <b><?= $post['username'];?></b>
    </div>
</div>
 <div class="card text-white bg-secondary my-2">
    <?php if($id == $newestPostId):?>
        <div class="bg-dark card-header">
            Newest
        </div>
    <?php endif;?>
    <div class="card-body">
        <h5 class="card-title"><?= $title;?></h5>
        <p class="card-text"><?= $body;?></p>
        <?php if($view):?>
            <a href="<?= ROOT_PATH . 'posts/post/' . $id . '/' . $currentPage;?>" class="btn btn-primary">View</a>
        <?php endif;?>
        <?php if(isset($_SESSION['loggedIn'])):?>
            <a href="<?= ROOT_PATH . 'posts/edit/' . $id . '/' . $currentPage;?>" class="btn btn-warning">Edit</a>
            <a href="<?= ROOT_PATH . 'posts/delete/' . $id . '/' . $currentPage;?>" class="btn btn-danger">Delete</a>
        <?php endif;?>
    </div>
    <div class="card-footer">
        <?= date('m/d/Y H:i', strtotime($date));?> By <b><?= $username;?></b>
    </div>
</div>
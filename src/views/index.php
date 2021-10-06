<?php require_once(__DIR__ . '/layout/header.php');?>

<?php if($data['posts'] == null):?>
    <div class="alert alert-danger top-buffer" role="alert">
        No Posts found.
    </div>
<?php else:?>
<?php foreach($data['posts'] as $post): ?>
    <div class="card text-white bg-secondary top-buffer">
        <?php if($post->id == $data['newestPostId']):?>
            <div class="bg-dark card-header">
                Newest
            </div>
        <?php endif;?>
        <div class="card-body">
            <h5 class="card-title"><?= $post->title;?></h5>
            <p class="card-text"><?= $post->body;?></p>
            <?php if(isset($_SESSION['loggedIn'])):?>
                <a href="<?= ROOT_PATH . 'posts/edit/' . $post->id;?>" class="btn btn-primary">Edit</a>
            <?php endif;?>
        </div>
        <div class="card-footer">
            <?= date('m/d/Y H:m', strtotime($post->created_at));?> By <b><?= $post->username;?></b>
        </div>
    </div>
<?php endforeach;?>
<?php endif;?>
<?php if($data['maxPage'] != 1 && $data['currentPage'] <= $data['maxPage']):?>
    <nav aria-label="...">
        <ul class="pagination top-buffer">
                <li class="page-item <?= $data['currentPage'] <= 1 ? 'disabled' : ''?>">
                    <a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] - 1)?>">Previous</a>
                </li>
            <?php if($data['currentPage'] > 1):?>
                <li class="page-item"><a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] - 1);?>"><?= ($data['currentPage'] - 1);?></a></li>
            <?php endif;?>
            <li class="page-item active">
            <span class="page-link">
                <?= $data['currentPage'];?>
            </span>
            </li>
            <?php if($data['currentPage'] < $data['maxPage']):?>
                <li class="page-item"><a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] + 1);?>"><?= ($data['currentPage'] + 1);?></a></li>
            <?php endif;?>
                <li class="page-item <?= $data['currentPage'] >= $data['maxPage'] ? 'disabled' : ''?>">
                    <a class="page-link" href="<?= ROOT_PATH;?>posts/index/<?= ($data['currentPage'] + 1)?>">Next</a>
                </li>
        </ul>
    </nav>
<?php endif;?>

<?php require_once(__DIR__ . '/layout/footer.php');?>
<?php require_once(__DIR__ . '/../templates/header.php');?>
    <?php if(isset($_SESSION['loggedIn'])):?>
        <a href="<?= ROOT_PATH . 'posts/create/';?>" class="my-2 btn btn-success">Create</a>
    <?php endif;?>

    <?php if($data['postsData'] == null):?>
        <div class="alert alert-danger" role="alert">
            No Posts found.
        </div>
    <?php else:?>
        <?php foreach($data['postsData'] as $post): ?>
            <?php require(__DIR__ . '/../templates/postCard.php');?>
        <?php endforeach;?>
    <?php endif;?>

    <?php require(__DIR__ . '/../templates/pagination.php');?>
<?php require_once(__DIR__ . '/../templates/footer.php');?>
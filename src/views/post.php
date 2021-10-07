<?php require_once(__DIR__ . '/layout/header.php');?>
<a href="<?=ROOT_PATH;?>posts/index/<?= $data['oldPageIndex'];?>"><button class="btn btn-primary my-2">&lt; Back</button></a>
<?php if($data['post'] == null):?>
    <div class="alert alert-danger" role="alert">
        No Post found.
    </div>
<?php else:?>
    <?php $post = $data['post'];?>
    <?php require(__DIR__ . '/templates/card.php');?>
<?php endif;?>

<?php require_once(__DIR__ . '/layout/footer.php');?>
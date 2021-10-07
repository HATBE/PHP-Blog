<?php require_once(__DIR__ . '/../templates/header.php');?>
<?php require(__DIR__ . '/../templates/backBtn.php');?>
<?php if($data['post'] == null):?>
    <div class="alert alert-danger" role="alert">
        No Post found.
    </div>
<?php else:?>
    <?php $post = $data['post'];?>
    <?php require(__DIR__ . '/../templates/postCard.php');?>
<?php endif;?>

<?php require_once(__DIR__ . '/../templates/footer.php');?>
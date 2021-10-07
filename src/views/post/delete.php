<?php require_once(__DIR__ . '/../templates/header.php');?>
    <?php require(__DIR__ . '/../templates/backBtn.php');?>
    <form method="POST">
        <h2>Delete Post number <?= $data['id'];?></h2>
        <h6>Are you Sure?</h6>
        <button id="sure" class="btn btn-danger" type="submit" name="sure">YES</button>
    </form>
<?php require_once(__DIR__ . '/../templates/footer.php');?>